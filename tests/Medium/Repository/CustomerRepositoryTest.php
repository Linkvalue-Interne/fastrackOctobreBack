<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerRepositoryTest extends KernelTestCase
{
    use RepositoryTraitTest;

    public function testRepositoryTrait()
    {
        $entity = new Customer();

        $entity
            ->setName('M6')
        ;

        $actual = self::$kernel->getContainer()
            ->get(CustomerRepository::class)->save($entity);

        $this->assertSame($entity, $actual);

        $this->initialState($actual);
    }
}
