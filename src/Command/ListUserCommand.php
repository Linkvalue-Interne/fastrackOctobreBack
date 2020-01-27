<?php


namespace App\Command;

use App\Component\retrieveAll\UserRetriever;
use App\Component\viewer\UserViewer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListUserCommand extends Command
{
    protected static $defaultName = 'app:user:list';

    /** @var UserRetriever */
    private $userRetriever;

    /** @var UserViewer */
    private $userViewer;

    /**
     * ListUserCommand constructor.
     *
     * @param UserRetriever $userRetriever
     * @param UserViewer $userViewer
     *
     * @param string|null $name
     */
    public function __construct(UserRetriever $userRetriever, UserViewer $userViewer, string $name = null)
    {
        parent::__construct($name);
        $this->userRetriever = $userRetriever;
        $this->userViewer = $userViewer;
    }

    protected function configure()
    {
        $this->setDescription('Returns the list of all users');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->userViewer->formatList($this->userRetriever->getAll());
        $io = new SymfonyStyle($input, $output);
        $io->writeln([
            '<fg=blue>User manager : List</>',
            '===================',
        ]);
        $io->table(['id', 'username', 'email', 'roles'], $users);
    }
}
