<?php


namespace App\Tests;

trait GetterTrait
{
    private $object;

    /**
     * @param string $property
     * @param $value
     * @throws \ReflectionException
     */
    public function reflectionProperty(string $property, $value): void
    {
        $this->object = $this->init();
        $reflectionObject = new \ReflectionClass($this->object);

        $prop = $reflectionObject->getProperty($property);
        $prop->setAccessible(true);
        $prop->setValue($this->object, $value);
    }

    /**
     * @dataProvider providerProperty
     * @param string $property
     * @param $value
     * @throws \ReflectionException
     */
    public function testGetters(string $property, $value): void
    {
        $this->reflectionProperty($property, $value);

        $getter = $this->getterFormat($property);

        $this->assertSame($value, $this->object->$getter());
    }

    /**
     * @dataProvider providerProperty
     * @param string $property
     */
    public function testGetterReturnNull(string $property): void
    {
        $getter = $this->getterFormat($property);

        $this->assertSame(null, $this->init()->$getter());
    }

    private function getterFormat(string $property): string
    {
        return $getter = 'get'.ucfirst($property);
    }
}
