<?php

namespace App\Tests\Medium\Command;

use App\Repository\UserRepository;
use App\Tests\Medium\IntegrationTraitTest;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    use IntegrationTraitTest;

    public function testExecuteSuccess()
    {
        $application = new Application(self::$kernel);
        $command = $application->find('app:create-user');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'username' => 'test',
            'email' => 'test@link-value.fr',
            'password' => 'password',
        ]);

        $output = $commandTester->getDisplay();

        $this->assertStringContainsString('test successfully generated!', $output);

        $userRepo = self::$kernel->getContainer()->get(UserRepository::class);
        $this->assertSame(4, count($userRepo->findAll()));

        $this->initialState($userRepo->findOneBy(['username' => 'test']));
        $this->assertSame(3, count($userRepo->findAll()));
    }
}
