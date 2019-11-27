<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PartnerRepositoryTest extends KernelTestCase
{
    protected static $kernel;

    public function setUp(): void
    {
        parent::setUp();
        self::$kernel = self::bootKernel();
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

        $actual = self::$kernel->getContainer()
            ->get(PartnerRepository::class)->save($entity);

        $this->assertSame($entity, $actual);

        $this->initialState($actual);
    }

    public function initialState($entity)
    {
        $entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $entity  = $entityManager->merge($entity);
        $entityManager->remove($entity);
        $entityManager->flush();
    }
}
