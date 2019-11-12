<?php


namespace App\Tests\Controller;

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
        ]
        ;

        $this->assertSame($dataToCompare, json_decode($this->client->getResponse()->getContent(), true));
    }
}
