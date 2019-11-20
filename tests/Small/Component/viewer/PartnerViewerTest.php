<?php


namespace App\Tests\Component\viewer;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use App\Entity\Partner;
use PHPUnit\Framework\TestCase;

class PartnerViewerTest extends TestCase
{
    private $retriever;

    private $partner;

    protected function setUp(): void
    {
        $this->retriever = $this->createMock(PartnerRetriever::class);
        $this->partner = $this->createMock(Partner::class);
        $this->partner
            ->setFirstName('Dark')
            ->setLastName('Vador')
            ->setJob('Sith')
            ->setEmail('dark.vador@link-value.fr')
            ->setPhoneNumber('01 02 03 04 05')
            ->setCustomer('client')
            ->setExperience(30)
            ->setProject('project')
            ->setAvatar('default.jpg');
    }

    public function init(): PartnerViewer
    {
        return new PartnerViewer();
    }

    public function testFormatListKeyExist()
    {
        $expect = [$this->partner, $this->partner, $this->partner];

        $dataFormatted = $this->init()->formatList($expect);

        $this->assertArrayHasKey('id', $dataFormatted[0]);
        $this->assertArrayHasKey('firstName', $dataFormatted[0]);
        $this->assertArrayHasKey('lastName', $dataFormatted[0]);
        $this->assertArrayHasKey('job', $dataFormatted[0]);
        $this->assertArrayHasKey('avatar', $dataFormatted[0]);
    }

    public function testFormatShowKeyExist()
    {
        $dataFormatted = $this->init()->formatShow($this->partner);

        $this->assertArrayHasKey('id', $dataFormatted);
        $this->assertArrayHasKey('firstName', $dataFormatted);
        $this->assertArrayHasKey('lastName', $dataFormatted);
        $this->assertArrayHasKey('job', $dataFormatted);
        $this->assertArrayHasKey('email', $dataFormatted);
        $this->assertArrayHasKey('phoneNumber', $dataFormatted);
        $this->assertArrayHasKey('experience', $dataFormatted);
        $this->assertArrayHasKey('customer', $dataFormatted);
        $this->assertArrayHasKey('project', $dataFormatted);
        $this->assertArrayHasKey('avatar', $dataFormatted);
    }
}
