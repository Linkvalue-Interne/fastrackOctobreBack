<?php

namespace tests\Small\Entity;

use App\Entity\Partner;
use PHPUnit\Framework\TestCase;

class PartnerTest extends TestCase
{
    /** @var Partner */
    private $partner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->partner = new Partner();
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetFirstNameReturnValue(): array
    {
        return ['correct string for first name attribute' => ['bob']];
    }

    /**
     * @dataProvider providerSetAndGetFirstNameReturnValue
     */
    public function testSetAndGetFirstNameReturnValue(string $data): void
    {
        $this->partner->setFirstName($data);
        $this->assertSame($data, $this->partner->getFirstName());
    }

    /**
     * success without value
     */
    public function testGetFirstNameReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getFirstName());
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetLastNameReturnValue(): array
    {
        return ['correct string for last name attribute' => ['Marley']];
    }

    /**
     * @dataProvider providerSetAndGetLastNameReturnValue
     */
    public function testSetAndGetLastNameReturnValue(string $data): void
    {
        $this->partner->setLastName($data);
        $this->assertSame($data, $this->partner->getLastName());
    }

    /**
     * success without value
     */
    public function testGetLastNameReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getLastName());
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetJobReturnValue(): array
    {
        return ['correct string job attribute' => ['Musicien']];
    }

    /**
     * @dataProvider providerSetAndGetJobReturnValue
     */
    public function testSetAndGetJobReturnValue(string $data): void
    {
        $this->partner->setJob($data);
        $this->assertSame($data, $this->partner->getJob());
    }

    /**
     * success without value
     */
    public function testGetJobReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getJob());
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetEmailReturnValue(): array
    {
        return ['correct string for email attribute' => ['bob.marley@link-value.fr']];
    }

    /**
     * @dataProvider providerSetAndGetEmailReturnValue
     */
    public function testSetAndGetEmailReturnValue(string $data): void
    {
        $this->partner->setEmail($data);
        $this->assertSame($data, $this->partner->getEmail());
    }

    /**
     * success without value
     */
    public function testGetEmailReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getEmail());
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetPhoneNumberReturnValue(): array
    {
        return ['correct string for number phone attribute' => ['01 02 03 04 05']];
    }

    /**
     * @dataProvider providerSetAndGetPhoneNumberReturnValue
     */
    public function testSetAndGetPhoneNumberReturnValue(string $data): void
    {
        $this->partner->setPhoneNumber($data);
        $this->assertSame($data, $this->partner->getPhoneNumber());
    }

    /**
     * success without value
     */
    public function testGetPhoneNumberReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getPhoneNumber());
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetExperienceReturnValue(): array
    {
        return [[10]];
    }

    /**
     * @dataProvider providerSetAndGetExperienceReturnValue
     */
    public function testSetAndGetExperienceReturnValue(int $data): void
    {
        $this->partner->setExperience($data);
        $this->assertSame($data, $this->partner->getExperience());
    }

    /**
     * success without value
     */
    public function testGetExperienceReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getExperience());
    }

    /**
     * DataProvider
     */
    public function providerGetCustomerReturnValue(): array
    {
        return ['correct string for customer attribute' => ['client']];
    }

    /**
     * @dataProvider providerGetCustomerReturnValue
     */
    public function testGetCustomerReturnValue(string $data): void
    {
        $this->partner->setCustomer($data);
        $this->assertSame($data, $this->partner->getCustomer());
    }

    /**
     * success without value
     */
    public function testGetCustomerReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getCustomer());
    }

    /**
     * DataProvider
     */
    public function providerSetAndGetProjectReturnValue(): array
    {
        return ['correct string for Project attribute' => ['project']];
    }

    /**
     * @dataProvider providerSetAndGetProjectReturnValue
     */
    public function testSetAndGetProjectReturnValue(string $data): void
    {
        $this->partner->setProject($data);
        $this->assertSame($data, $this->partner->getProject());
    }

    /**
     * success without value
     */
    public function testGetProjectReturnNull(): void
    {
        $partner = new Partner();
        $this->assertSame(null, $partner->getProject());
    }
}
