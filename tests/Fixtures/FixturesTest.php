<?php


namespace App\Tests\Fixtures;

use App\Entity\Partner;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FixturesTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testPresenceAllPartnerInBDD()
    {
        $partners = $this->entityManager
            ->getRepository(Partner::class)
            ->findAll()
        ;

        self::assertCount(4, $partners);
    }

    public function testInfoPartnerInBDDForTests()
    {
        $partner_0 = $this->getPartner(1);

        self::assertSame('Charles', $partner_0->getFirstname());
        self::assertSame('Xavier', $partner_0->getLastname());
        self::assertSame('Professeur', $partner_0->getJob());
        self::assertSame('charles.xavier@link-vaue.fr', $partner_0->getEmail());
        self::assertSame('01 02 03 04 05', $partner_0->getPhoneNumber());
        self::assertSame(50, $partner_0->getExperience());
        self::assertSame('client', $partner_0->getCustomer());
        self::assertSame('project', $partner_0->getProject());

        $partner_1 = $this->getPartner(2);

        self::assertSame('Jimmy', $partner_1->getFirstname());
        self::assertSame('Hendrix', $partner_1->getLastname());
        self::assertSame('Musicien', $partner_1->getJob());
        self::assertSame('jimmy.hendrix@link-vaue.fr', $partner_1->getEmail());
        self::assertSame('01 02 03 04 05', $partner_1->getPhoneNumber());
        self::assertSame(40, $partner_1->getExperience());
        self::assertSame('client', $partner_1->getCustomer());
        self::assertSame('project', $partner_1->getProject());

        $partner_2 = $this->getPartner(3);

        self::assertSame('Dark', $partner_2->getFirstname());
        self::assertSame('Vador', $partner_2->getLastname());
        self::assertSame('Sith', $partner_2->getJob());
        self::assertSame('dark.vador@link-vaue.fr', $partner_2->getEmail());
        self::assertSame('01 02 03 04 05', $partner_2->getPhoneNumber());
        self::assertSame(60, $partner_2->getExperience());
        self::assertSame('client', $partner_2->getCustomer());
        self::assertSame('project', $partner_2->getProject());

        $partner_3 = $this->getPartner(4);

        self::assertSame('Bruce', $partner_3->getFirstname());
        self::assertSame('Wayne', $partner_3->getLastname());
        self::assertSame('Milliardaire', $partner_3->getJob());
        self::assertSame('bruce.wayne@link-vaue.fr', $partner_3->getEmail());
        self::assertSame('01 02 03 04 05', $partner_3->getPhoneNumber());
        self::assertSame(30, $partner_3->getExperience());
        self::assertSame('client', $partner_3->getCustomer());
        self::assertSame('project', $partner_3->getProject());
    }

    protected function getPartner(int $id): ?Partner
    {
        return $this->entityManager
            ->getRepository(Partner::class)
            ->find($id);
    }
}
