<?php


namespace App\Tests\Small\Component\writer;

use App\Component\writer\Writer;
use App\Entity\Partner;
use App\Entity\PartnerSkill;
use App\Entity\User;
use App\Repository\PartnerRepository;
use App\Repository\PartnerSkillRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class WriterTest extends TestCase
{
    private $partnerRepo;

    private $partnerSkillRepo;

    private $userRepo;

    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->partnerRepo = $this->createMock(PartnerRepository::class);
        $this->partnerSkillRepo = $this->createMock(PartnerSkillRepository::class);
        $this->userRepo = $this->createMock(UserRepository::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
    }

    public function init()
    {
        return new Writer($this->partnerRepo, $this->partnerSkillRepo, $this->userRepo, $this->entityManager);
    }

    public function testSavePartnerReturnPartnerEntity()
    {
        $partner = $this->createMock(Partner::class);

        $this->partnerRepo
            ->expects($this->once())
            ->method('save')
            ->with($partner)
            ->willReturn($partner);

        $actual = $this->init()->savePartner($partner);

        $this->assertSame($partner, $actual);
    }

    public function testSavePartnerSkillReturnPartnerSkillEntity()
    {
        $partnerSkill = $this->createMock(PartnerSkill::class);

        $this->partnerSkillRepo
            ->expects($this->once())
            ->method('save')
            ->with($partnerSkill)
            ->willReturn($partnerSkill);

        $actual = $this->init()->savePartnerSkill($partnerSkill);

        $this->assertSame($partnerSkill, $actual);
    }

    public function testSaveUserReturnUserEntity()
    {
        $user = $this->createMock(User::class);

        $this->userRepo
            ->expects($this->once())
            ->method('save')
            ->with($user)
            ->willReturn($user);

        $actual = $this->init()->saveUser($user);

        $this->assertSame($user, $actual);
    }
}
