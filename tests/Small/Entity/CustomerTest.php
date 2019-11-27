<?php


namespace App\Tests\Small\Entity;

use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTraitTest, SetterTraitTest;
    /** {@inheritDoc} */
    public function init()
    {
        return new Customer();
    }
    /** {@inheritDoc} */
    public function providerProperty(): array
    {
        return [
            ['name', 'M6'],
        ];
    }
}
