<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RepositoryTest extends KernelTestCase
{
    private $repository;

    private $entityManager;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->bootKernel()
            ->getContainer()
            ->get(PartnerRepository::class);

        $this->entityManager = $this->bootKernel()
            ->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testRepositoryTrait()
    {
        $entity = new Partner();

        $entity
            ->setFirstName('Master')
            ->setLastName('World')
            ->setJob('Leader')
            ->setEmail('master.world@link-value.fr')
            ->setPhoneNumber('01 02 01 03')
            ->setExperience(10)
            ->setCustomer('client')
            ->setProject('project')
        ;

        $actual = $this->repository->save($entity);

        $this->assertSame($entity, $actual);

        $this->initialState($actual);
    }

    public function initialState($entity)
    {
        $entity  = $this->entityManager->merge($entity);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
