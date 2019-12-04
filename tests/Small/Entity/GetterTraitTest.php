<?php


namespace App\Tests\Small\Entity;

use Symfony\Component\PropertyAccess\PropertyAccess;

trait GetterTraitTest
{
    private $object;

    /** @var \Symfony\Component\PropertyAccess\PropertyAccessor  */
    private $propertyAccessor;

    public function setUp(): void
    {
        parent::setUp();
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        $this->object = $this->init();
    }

    /**
     * @param string $property
     * @param $value
     * @dataProvider providerProperty
     */
    public function testGetters(string $property, $value): void
    {
        if (method_exists($this->object, 'get'.$property)) {
            $this->propertyAccessor->setValue($this->object, $property, $value);

            $actual = $this->propertyAccessor->getValue($this->object, $property);

            $this->assertSame($value, $actual);
        }
        if (method_exists($this->object, 'add'.ucfirst($property))) {
            die('ok');
        }
    }

    /**
     * @dataProvider providerProperty
     * @param string $property
     */
    public function testGetterReturnNull(string $property): void
    {
        if (method_exists($this->object, 'get'.$property)) {
            $actual = $this->propertyAccessor->getValue($this->object, $property);

            $this->assertSame(null, $actual);
        }
    }
}
