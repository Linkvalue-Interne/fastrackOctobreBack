<?php


namespace App\Tests\Small\Repository;

use App\Entity\EntityInterface;
use App\Repository\SaveEntityTrait;
use PHPUnit\Framework\TestCase;

class SaveEntityTraitTest extends TestCase
{
    public function init()
    {
        return $this->getMockForTrait(SaveEntityTrait::class);
    }

    public function testSaveReturnEntity()
    {
        $this->markTestSkipped("a compléter");
        $entity = $this->createMock(EntityInterface::class);

        $actual = $this->init()
            ->expects($this->once())
            ->method('save')
            ->with($entity)
            ->willReturn($entity);

        $this->assertSame($entity, $actual);
    }
}
