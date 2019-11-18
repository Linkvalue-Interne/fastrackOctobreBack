<?php


namespace App\Tests\Component\viewer;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use App\Entity\Partner;
use PHPUnit\Framework\TestCase;

class PartnerViewerTest extends TestCase
{
    private $retriever;

    protected function setUp(): void
    {
        $this->retriever = $this->createMock(PartnerRetriever::class);
    }

    public function init(): PartnerViewer
    {
        return new PartnerViewer($this->retriever);
    }

    public function testFormatListKeyExist()
    {
        $expect[] = $this->createMock(Partner::class);

        $this->retriever
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($expect);

        $dataFormatted = $this->init()->formatList();

        self::assertArrayHasKey('id', $dataFormatted[0]);
        self::assertArrayHasKey('firstName', $dataFormatted[0]);
        self::assertArrayHasKey('lastName', $dataFormatted[0]);
        self::assertArrayHasKey('job', $dataFormatted[0]);
        self::assertArrayHasKey('avatar', $dataFormatted[0]);
    }

    public function testFormatShowKeyExist()
    {
        $expect = $this->createMock(Partner::class);

        $this->retriever
            ->expects($this->once())
            ->method('getOne')
            ->willReturn($expect);

        $dataFormatted = $this->init()->formatShow(1);

        self::assertArrayHasKey('id', $dataFormatted);
        self::assertArrayHasKey('firstName', $dataFormatted);
        self::assertArrayHasKey('lastName', $dataFormatted);
        self::assertArrayHasKey('job', $dataFormatted);
        self::assertArrayHasKey('email', $dataFormatted);
        self::assertArrayHasKey('phoneNumber', $dataFormatted);
        self::assertArrayHasKey('experience', $dataFormatted);
        self::assertArrayHasKey('customer', $dataFormatted);
        self::assertArrayHasKey('project', $dataFormatted);
        self::assertArrayHasKey('avatar', $dataFormatted);
    }
}
