<?php


namespace App\Tests\Small\Component\writer;

use App\Component\writer\Writer;
use App\Entity\Partner;
use App\Repository\PartnerRepository;
use PHPUnit\Framework\TestCase;

class WriterTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->createMock(PartnerRepository::class);
    }

    public function init()
    {
        return new Writer($this->repository);
    }

    public function testSavePartnerReturnPartnerEntity()
    {
        $partner = $this->createMock(Partner::class);

        $this->repository
            ->expects($this->once())
            ->method('save')
            ->with($partner)
            ->willReturn($partner);

        $actual = $this->init()->savePartner($partner);

        $this->assertSame($partner, $actual);
    }
}
