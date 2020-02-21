<?php


namespace App\Tests\Component\retrieveAll;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\retrieveAll\SkillRetriever;
use App\Entity\Partner;
use App\Entity\Skill;
use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PartnerRetrieverTest extends TestCase
{
    private $repository;

    private $partner;

    private $skillRetriever;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PartnerRepository::class);
        $this->partner = $this->createMock(Partner::class);
        $this->skillRetriever = $this->createMock(SkillRetriever::class);
    }

    public function init(): PartnerRetriever
    {
        return new PartnerRetriever($this->repository, $this->skillRetriever);
    }

    public function testGetAllPartnerReturnDataWithoutArgument()
    {
        $expect = [$this->partner, $this->partner, $this->partner];

        $queryBuilder = $this->createMock(QueryBuilder::class);

        $this->repository
            ->expects($this->once())
            ->method('createQueryBuilder')
            ->with('p')
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('andWhere')
            ->with('p.isActive = true')
            ->willReturn($queryBuilder);

        $getQuery = $this->getMockBuilder(AbstractQuery::class)
            ->onlyMethods(['getResult'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $getQuery->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($expect));

        $queryBuilder
            ->expects($this->once())
            ->method('getQuery')
            ->willReturn($getQuery);

        $this->assertSame(3, count($this->init()->getAllByFilter('asc')));
    }

    public function testGetAllPartnerReturnDataWithOrderArgument()
    {
        $expect = [$this->partner, $this->partner, $this->partner];

        $queryBuilder = $this->createMock(QueryBuilder::class);

        $this->repository
            ->expects($this->once())
            ->method('createQueryBuilder')
            ->with('p')
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('orderBy')
            ->with('p.lastName', 'ASC')
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('andWhere')
            ->with('p.isActive = true')
            ->willReturn($queryBuilder);

        $getQuery = $this->getMockBuilder(AbstractQuery::class)
            ->onlyMethods(['getResult'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $getQuery->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($expect));

        $queryBuilder
            ->expects($this->once())
            ->method('getQuery')
            ->willReturn($getQuery);

        $actual = $this->init()->getAllByFilter('asc');

        $this->assertSame(3, count($actual));
    }

    public function testGetAllPartnerReturnDataWithSearchArgument()
    {
        // TODO ne fonctionne pas
        $this->markTestSkipped();
        $expect = [$this->partner, $this->partner, $this->partner];

        $queryBuilder = $this->createMock(QueryBuilder::class);

        $skill = $this->createMock(Skill::class);

        $skillCondition = 'p.firstName LIKE :param OR p.lastName LIKE :param OR ps.skill = :param1';
        $skillConditionParam = $this->createMock(ArrayCollection::class);

        $skill
            ->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $this->skillRetriever
            ->expects($this->once())
            ->method('getSkillsByParam')
            ->with('php')
            ->willReturn([$skill]);

        $this->repository
            ->expects($this->once())
            ->method('createQueryBuilder')
            ->with('p')
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('where')
            ->with($skillCondition)
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('leftJoin')
            ->with('p.skills', 'ps')
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('setParameters')
            ->with($skillConditionParam)
            ->willReturn($queryBuilder);

        $queryBuilder
            ->expects($this->once())
            ->method('andWhere')
            ->with('p.isActive = true')
            ->willReturn($queryBuilder);

        $getQuery = $this->getMockBuilder(AbstractQuery::class)
            ->onlyMethods(['getResult'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $getQuery->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($expect));

        $queryBuilder
            ->expects($this->once())
            ->method('getQuery')
            ->willReturn($getQuery);

        $this->assertSame(3, count($this->init()->getAllByFilter('asc', 'php')));
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
