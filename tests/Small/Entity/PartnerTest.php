<?php

namespace tests\Small\Entity;

use App\Entity\Partner;
use App\Tests\GetterAndSetterInterface;
use App\Tests\GetterTrait;
use App\Tests\SetterTrait;
use PHPUnit\Framework\TestCase;

class PartnerTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTrait, SetterTrait;

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
}
