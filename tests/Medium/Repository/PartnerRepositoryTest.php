<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use App\Tests\Medium\IntegrationTraitTest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PartnerRepositoryTest extends KernelTestCase
{
    use IntegrationTraitTest;

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
}
