<?php


namespace App\Tests\Controller;

use App\CustomException\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PartnerControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = $this->createClient();
    }

    public function testList()
    {
        $this->client->request('GET', '/api/partner/list');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        $dataToCompare = [
                'id' => 1,
                'firstName' => 'Charles',
                'lastName' => 'Xavier',
                'job' => 'Professeur',
                'avatar' => 'cat4.jpg',
            ]
        ;

        $this->assertGreaterThanOrEqual(1, count(json_decode($this->client->getResponse()->getContent())));
        $this->assertSame($dataToCompare, json_decode($this->client->getResponse()->getContent(), true)[0]);
    }

    public function testShow()
    {
        $this->client->request('GET', '/api/partner/1');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        $dataToCompare = [
            'id' => 1,
            'firstName' => 'Charles',
            'lastName' => 'Xavier',
            'job' => 'Professeur',
            'email' => 'charles.xavier@link-vaue.fr',
            'phoneNumber' => '01 02 03 04 05',
            'experience' => 50,
            'customer' => 'client',
            'project' => 'project',
            'avatar' => 'cat4.jpg',
        ]
        ;

        $this->assertSame($dataToCompare, json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testDeleteExistId()
    {
        $this->markTestSkipped("A compléter");

        $expect = $this->createMock(\stdClass::class);

        $expect
            ->expects($this->once())
            ->willReturn(['statusCode' => Response::HTTP_OK]);


        $this->client->request('DELETE', '/api/partner/1');

        $this->assertSame($expect, json_decode($this->client->getResponse()->getContent()));
        $this->assertJson($this->client->getResponse()->getContent());
    }

    public function testDeleteNotExistId()
    {
        $this->markTestSkipped("A compléter");

        $data = [
            "status" => 404,
            "message" => "Invalid argument",
            ]
        ;

        $expect = $this->createMock(\stdClass::class);

        $expect
            ->expects($this->once())
            ->willReturn($data);

        $this->client->request('DELETE', '/api/partner/10');

        $this->assertSame($expect, json_decode($this->client->getResponse()->getContent()), true);
        $this->assertJson($this->client->getResponse()->getContent());
    }
}
