<?php


namespace App\Tests\Small\Entity;

use App\Entity\Category;
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
            ['skillId', 1],
        ];
    }
}
