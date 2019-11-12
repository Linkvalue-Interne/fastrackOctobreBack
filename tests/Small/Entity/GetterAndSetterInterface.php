<?php


namespace App\Tests\Small\Entity;

use Doctrine\ORM\Mapping\Entity;

interface GetterAndSetterInterface
{
    /**
     * @return Entity
     */
    public function init();

    /**
     * [Entity property, value]
     * @return array
     */
    public function providerProperty(): array;
}
