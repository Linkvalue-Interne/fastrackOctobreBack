<?php


namespace App\Tests\Small\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait SetterTraitTest
{
    /**
     * @dataProvider providerProperty
     * @param string $property
     * @param $value
     */
    public function testSetters(string $property, $value): void
    {
        $object = $this->init();

        $setter = 'set'.ucfirst($property);
        $getter = 'get'.ucfirst($property);
        $addElement = 'add'.ucfirst($property);
        $removeElement = 'remove'.ucfirst($property);
        $arrayCollection = $this->createMock(ArrayCollection::class);

        if (method_exists($object, $setter)) {
            $object->$setter($value);
            $this->assertSame($value, $object->$getter());
        }
        if (method_exists($object, $addElement)) {
            $object->$addElement($value);
            $this->asserInstanceOf(Collection::class, $object->$getter());
        }
        if (method_exists($object, $removeElement)) {
            $object->$removeElement($value);
            $this->assertSame($arrayCollection, $object->$getter());
        }
    }
}
