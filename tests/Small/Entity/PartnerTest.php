<?php
namespace tests\Small\Entity;

use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\Skill;
use App\Tests\Small\Entity\GetterAndSetterInterface;
use App\Tests\Small\Entity\GetterTraitTest;
use App\Tests\Small\Entity\SetterTraitTest;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class PartnerTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTraitTest, SetterTraitTest;
    /** {@inheritDoc} */
    public function init()
    {
        return new Partner();
    }
    /** {@inheritDoc} */
    public function providerProperty(): array
    {
        return [
            ['lastName', 'Marley'],
            ['job', 'Musician'],
            ['email', 'bob.marley@link-value.fr'],
            ['phoneNumber', '01 02 03 04 05'],
            ['experience', 20],
            ['customer', 'Client'],
            ['project', 'Booster'],
        ];
    }

    public function testGetSkills()
    {
        $this->assertInstanceOf(Collection::class, $this->init()->getSkills());
    }

    public function testAddAndRemoveSkill()
    {
        $object = $this->init();
        $expect = $this->createMock(PartnerSkill::class);

        $object->addSkill($expect);

        $actual = count($object->getSkills());
        $this->assertSame(1, $actual);

        $object->removeSkill($expect);

        $actual = count($object->getSkills());
        $this->assertSame(0, $actual);
    }

    public function testAddAndRemoveFavoritesSkill()
    {
        $object = $this->init();
        $expect = $this->createMock(Skill::class);

        $object->addFavorite($expect);

        $actual = count($object->getFavorites());

        $this->assertSame(1, $actual);
        $object->removeFavorite($expect);

        $actual = count($object->getFavorites());
        $this->assertSame(0, $actual);
    }
}
