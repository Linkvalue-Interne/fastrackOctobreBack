<?php
namespace tests\Small\Entity;

use App\Entity\Partner;
use App\Tests\Small\Entity\GetterAndSetterInterface;
use App\Tests\Small\Entity\GetterTraitTest;
use App\Tests\Small\Entity\SetterTraitTest;
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
}
