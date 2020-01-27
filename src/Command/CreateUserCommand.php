<?php

namespace App\Command;

use App\Component\builder\UserBuilder;
use App\Component\writer\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:user:create';

    /** @var UserBuilder */
    private $userBuilder;

    /** @var Writer */
    private $writer;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * CreateUserCommand constructor.
     *
     * @param UserBuilder $builder
     * @param Writer $writer
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @param string|null $name
     */
    public function __construct(
        UserBuilder $builder,
        Writer $writer,
        UserPasswordEncoderInterface $passwordEncoder,
        string $name = null
    ) {
        parent::__construct($name);

        $this->userBuilder = $builder;
        $this->writer = $writer;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new user.')
            ->setHelp('This command allows you to create a user')
            ->addArgument(
                'username',
                null,
                'Username'
            )
            ->addArgument(
                'email',
                null,
                'Email used for connection'
            )
            ->addArgument(
                'password',
                null,
                'Password used for connection'
            );
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('username') && !$input->getArgument('email') && !$input->getArgument('password')) {
            try {
                $helper = $this->getHelper('question');

                $usernameQuestion = new Question('Username: ');
                $this->questionValidation($usernameQuestion, 4);
                $input->setArgument('username', $helper->ask($input, $output, $usernameQuestion));

                $emailQuestion = new Question('Email: ');
                $this->questionValidation($emailQuestion, 4, true);
                $input->setArgument('email', $helper->ask($input, $output, $emailQuestion));

                $passwordQuestion = new Question('Password: ');
                $this->questionValidation($passwordQuestion, 4);
                $input->setArgument('password', $helper->ask($input, $output, $passwordQuestion));
            } catch (\Exception $exception) {
            }
        }

        return 0;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        if ($input->getArgument('username') && $input->getArgument('email') && $input->getArgument('password')) {
            $data = [
                'username' => $input->getArgument('username'),
                'email' => $input->getArgument('email'),
                'password' => $input->getArgument('password'),
            ];

            try {
                $user = $this->userBuilder->buildUser($data);

                $passwordEncoded = $this->passwordEncoder->encodePassword($user, $data['password']);

                $user->setPassword($passwordEncoded);

                $this->writer->saveUser($user);

                $output->writeln([
                    '<fg=blue>User Creator</>',
                    '=============',
                ]);

                $io->success(ucfirst($user->getUsername()) . ' successfully generated!');
            } catch (\Exception $exception) {
                $output->writeln([
                    '<fg=blue>User Creator</>',
                    '=============',
                ]);
                $output->writeln('<fg=red>Email: '.$exception->getErrors()['email'].'</>');
                $output->writeln('<fg=magenta>Try again please !!</>');
            }
        } else {
            $output->writeln([
                '<fg=blue>User Creator</>',
                '=============',
            ]);
            $output->writeln('use <fg=green>app:create-user \<username> \<email> \<password></> or');
            $output->writeln('use <fg=green>app:create-user and follow instructions !!</>');
            $output->writeln('');
            $output->writeln('<fg=magenta>Try again please !!</>');
        }
    }

    protected function questionValidation(Question $question, int $maxAttempts = 1, bool $isEmail = false)
    {
        $question->setValidator(function ($value) {
            if (trim($value) == '') {
                throw new \Exception('This value cannot be empty');
            }

            return $value;
        });

        if ($isEmail) {
            $question->setValidator(function ($value) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('This value is not a valid email address');
                }

                return $value;
            });
        }

        $question->setMaxAttempts($maxAttempts);
    }
}
