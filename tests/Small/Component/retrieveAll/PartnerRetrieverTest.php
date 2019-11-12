<?php


namespace App\Tests\Component\retrieveAll;

use App\Component\retrieveAll\PartnerRetriever;
use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PartnerRetrieverTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PartnerRepository::class);
    }

    public function init(): PartnerRetriever
    {
        return new PartnerRetriever($this->repository);
    }

    public function testAllPartnerReturnData()
    {
        $expect[] = $this->createMock(Partner::class);
        $this->repository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($expect);

        self::assertCount(1, $this->init()->getAll());
    }

    public function testAllPartnerReturnArray()
    {
        $expect[] = $this->createMock(Partner::class);
        $this->repository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($expect);

        self::assertIsArray($this->init()->getAll());
    }

    public function testOnePartnerReturnSuccess()
    {
        $expect = $this->createMock(Partner::class);
        $this->repository
            ->expects($this->once())
            ->method('find')
            ->willReturn($expect);

        self::assertSame($expect, $this->init()->getOne(1));
    }
}
