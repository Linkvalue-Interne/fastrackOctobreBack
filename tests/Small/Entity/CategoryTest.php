<?php


namespace App\Tests\Small\Entity;

use App\Entity\Category;
use App\Entity\Skill;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTraitTest, SetterTraitTest;

    /** {@inheritDoc} */
    public function init()
    {
        return new Category();
    }

    /** {@inheritDoc} */
    public function providerProperty(): array
    {
        return [
            ['name', 'backend'],
            ['parentId', 1],
        ];
    }

    public function testGetSkills()
    {
        $this->assertInstanceOf(Collection::class, $this->init()->getSkills());
    }

    public function testAddAndRemoveSkill()
    {
        $object = $this->init();
        $expect = $this->createMock(Skill::class);

        $object->addSkill($expect);

        $actual = count($object->getSkills());
        $this->assertSame(1, $actual);

        $object->removeSkill($expect);

        $actual = count($object->getSkills());
        $this->assertSame(0, $actual);
    }
}
