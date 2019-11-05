<?php

namespace tests\Entity;

use App\Entity\Partner;
use PHPUnit\Framework\TestCase;

class PartnerTest extends TestCase
{
    protected $partner;

    protected function setUp()
    {
        parent::setUp();

        $this->partner = new Partner();

        $firstname = 'bob';
        $lastname = 'marley';
        $job = 'chanteur';
        $email = $firstname . '.' . $lastname . '@gmail.com';
        $phone_number = '01 02 03 04 05';
        $experience = 1;
        $customer = 'client';
        $project = 'project';

        $this->partner
            ->setFirstname($firstname)
            ->setLastname($lastname)
            ->setJob($job)
            ->setEmail($email)
            ->setPhoneNumber($phone_number)
            ->setExperience($experience)
            ->setCustomer($customer)
            ->setProject($project);
    }

    public function testSetters()
    {
        $this->partner
            ->setFirstname('michel')
            ->setLastname('ange')
            ->setJob('peintre')
            ->setEmail('chapelle.sixtine@gmail.com')
            ->setPhoneNumber('66 66 66 66 66')
            ->setExperience(88)
            ->setCustomer('newClient')
            ->setProject('newProject');

        self::assertSame('michel', $this->partner->getFirstname());
        self::assertSame('ange', $this->partner->getLastname());
        self::assertSame('peintre', $this->partner->getJob());
        self::assertSame('chapelle.sixtine@gmail.com', $this->partner->getEmail());
        self::assertSame('66 66 66 66 66', $this->partner->getPhoneNumber());
        self::assertSame(88, $this->partner->getExperience());
        self::assertSame('newClient', $this->partner->getCustomer());
        self::assertSame('newProject', $this->partner->getProject());

        self::assertInstanceOf(Partner::class, $this->partner->setFirstname('string'));
        self::assertInstanceOf(Partner::class, $this->partner->setLastname('string'));
        self::assertInstanceOf(Partner::class, $this->partner->setJob('string'));
        self::assertInstanceOf(Partner::class, $this->partner->setEmail('string'));
        self::assertInstanceOf(Partner::class, $this->partner->setPhoneNumber('string'));
        self::assertInstanceOf(Partner::class, $this->partner->setExperience(0));
        self::assertInstanceOf(Partner::class, $this->partner->setCustomer('string'));
        self::assertInstanceOf(Partner::class, $this->partner->setProject('string'));
    }

    public function testGettersNotNull()
    {
        self::assertIsString($this->partner->getFirstname());
        self::assertIsString($this->partner->getLastname());
        self::assertIsString($this->partner->getJob());
        self::assertIsString($this->partner->getEmail());
        self::assertIsString($this->partner->getPhoneNumber());
        self::assertIsInt($this->partner->getExperience());

        self::assertSame('bob', $this->partner->getFirstname());
        self::assertSame('marley', $this->partner->getLastname());
        self::assertSame('chanteur', $this->partner->getJob());
        self::assertSame('bob.marley@gmail.com', $this->partner->getEmail());
        self::assertSame('01 02 03 04 05', $this->partner->getPhoneNumber());
        self::assertSame(1, $this->partner->getExperience());
        self::assertSame('client', $this->partner->getCustomer());
        self::assertSame('project', $this->partner->getProject());
    }

    public function testGettersNull()
    {
        $partnerNull = new Partner();

        self::assertNull($partnerNull->getId());
        self::assertNull($partnerNull->getFirstname());
        self::assertNull($partnerNull->getLastname());
        self::assertNull($partnerNull->getJob());
        self::assertNull($partnerNull->getEmail());
        self::assertNull($partnerNull->getPhoneNumber());
        self::assertNull($partnerNull->getExperience());
        self::assertNull($partnerNull->getCustomer());
        self::assertNull($partnerNull->getProject());
    }
}
