<?php

namespace App\Command;

use App\Component\retrieveAll\UserRetriever;
use App\Component\writer\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeleteUserCommand extends Command
{
    protected static $defaultName = 'app:user:delete';

    /** @var UserRetriever */
    private $userRetriever;

    /** @var Writer */
    private $writer;

    /**
     * DeleteUserCommand constructor.
     *
     * @param UserRetriever $userRetriever
     * @param Writer $writer
     *
     * @param string|null $name
     */
    public function __construct(UserRetriever $userRetriever, Writer $writer, string $name = null)
    {
        parent::__construct($name);

        $this->userRetriever = $userRetriever;
        $this->writer = $writer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Delete user by id.')
            ->setHelp('This command allows you to delete a user')
            ->addArgument(
                'id',
                null,
                'Identifier in the database',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        if ((int)$input->getArgument('id')) {
            $user = $this->userRetriever->getOne($input->getArgument('id'));
        }

        if ($user) {
            $io->writeln([
                '<fg=blue>User manager: Delete</>',
                '====================',
            ]);
            if ($io->confirm(
                'Souhaitez vous supprimer l\'utilisateur <fg=white>' .ucfirst($user->getUsername()).'</> ?'
            )) {
                $this->writer->deleteEntity($user);
                $io->success('Utilisateur correctement supprimé !!');
                exit();
            };
        }

        $io->warning('Veuillez taper un identifiant correct');
    }
}
