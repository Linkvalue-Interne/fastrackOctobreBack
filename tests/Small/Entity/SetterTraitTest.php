<?php


namespace App\Tests\Small\Entity;

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

        $object->$setter($value);

        $this->assertSame($value, $object->$getter());
    }
}
