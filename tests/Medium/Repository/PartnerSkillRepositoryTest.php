<?php


namespace App\Tests\Medium\Repository;

use App\Entity\PartnerSkill;
use App\Repository\PartnerRepository;
use App\Repository\PartnerSkillRepository;
use App\Repository\SkillRepository;
use App\Tests\Medium\IntegrationTraitTest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PartnerSkillRepositoryTest extends KernelTestCase
{
    use IntegrationTraitTest;

    public function init()
    {
        return new PartnerSkill();
    }

    public function testRepositoryTest()
    {
        $entity = $this->init();

        $partner = self::$kernel->getContainer()->get(PartnerRepository::class)->findOneById(1);

        $skill = self::$kernel->getContainer()->get(SkillRepository::class)->findOneById(1);

        $entity
            ->setPartner($partner)
            ->setSkill($skill)
            ->setLevel(99)
        ;

        $actual = self::$kernel->getContainer()
            ->get(PartnerSkillRepository::class)
            ->save($entity);

        $this->assertSame($entity, $actual);

        $this->initialState($actual);
    }
}
