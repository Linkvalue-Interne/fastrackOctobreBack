<?php


namespace App\Tests\Component\retrieveAll;

use App\Component\retrieveAll\PartnerRetriever;
use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PartnerRetrieverTest extends TestCase
{
    private $repository;

    private $partner;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PartnerRepository::class);
        $this->partner = $this->createMock(Partner::class);
    }

    public function init(): PartnerRetriever
    {
        return new PartnerRetriever($this->repository);
    }

    public function testAllPartnerReturnDataWithoutArgument()
    {
        $expect = [$this->partner, $this->partner, $this->partner];

        $this->repository
            ->expects($this->once())
            ->method('findBy')
            ->with(['isActive' => true])
            ->willReturn($expect);

        $this->assertCount(3, $this->init()->getAll(null));
    }

    public function testAllPartnerReturnDataWithAZArgument()
    {
        $expect = [$this->partner, $this->partner, $this->partner];

        $filter = 'ASC';

        $this->repository
            ->expects($this->once())
            ->method('findBy')
            ->with(['isActive' => true], ['firstName' => $filter])
            ->willReturn($expect);

        $this->assertSame($expect, $this->init()->getAll($filter));
    }

    public function testAllPartnerReturnDataWithZAArgument()
    {
        $expect = [$this->partner, $this->partner, $this->partner];

        $filter = 'DESC';

        $this->repository
            ->expects($this->once())
            ->method('findBy')
            ->with(['isActive' => true], ['firstName' => $filter])
            ->willReturn($expect);

        $this->assertSame($expect, $this->init()->getAll($filter));
    }

    public function testOnePartnerReturnSuccess()
    {
        $id = 1;
        $expect = $this->createMock(Partner::class);

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => $id, 'isActive' => true])
            ->willReturn($expect);

        $this->assertSame($expect, $this->init()->getOne($id));
    }

    public function testOnePartnerReturnNull()
    {
        $id = 1;

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => $id, 'isActive' => true])
            ->willReturn([]);

        $this->assertSame([], $this->init()->getOne($id));
    }
}
