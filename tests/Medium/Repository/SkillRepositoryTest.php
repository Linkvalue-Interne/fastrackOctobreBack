<?php


namespace App\Tests\Medium\Repository;

use App\Entity\Skill;
use App\Repository\SkillRepository;
use App\Tests\Medium\IntegrationTraitTest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SkillRepositoryTest extends KernelTestCase
{
    use IntegrationTraitTest;

    public function testSaveSkill()
    {
        $skill = new Skill();

        $skill
            ->setName('newSkill')
            ->setIcon('newSkill.jpg');

        $actual = self::$kernel->getContainer()
            ->get(SkillRepository::class)->save($skill);

        $this->assertSame($skill, $actual);

        $this->initialState($actual);
    }
}
