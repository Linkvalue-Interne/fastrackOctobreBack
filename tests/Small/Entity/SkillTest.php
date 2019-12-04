<?php


namespace App\Tests\Small\Entity;

use App\Entity\Skill;
use PHPUnit\Framework\TestCase;

class SkillTest extends TestCase implements GetterAndSetterInterface
{
    use GetterTraitTest, SetterTraitTest;

    /** {@inheritDoc} */
    public function init()
    {
        return new Skill();
    }

    /** {@inheritDoc} */
    public function providerProperty(): array
    {
        return [
            ['name', 'PHP'],
            ['icon', 'php.jpg']
        ];
    }
}
