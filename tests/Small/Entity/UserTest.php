<?php

namespace App\Tests\Small\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests\Small\Entity
 */
class UserTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTraitTest, SetterTraitTest;

    /**
     * @inheritDoc
     */
    public function init()
    {
        return new User();
    }

    /**
     * @inheritDoc
     */
    public function providerProperty(): array
    {
        return [
          ["username", "admin"],
          ["email", "admin@link-value.fr"],
          ["password", "password"],
        ];
    }
}
