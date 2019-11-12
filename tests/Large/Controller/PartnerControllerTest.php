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

    public function testListReturnResponseStatus()
    {
        $this->client->request('GET', '/api/partner/list');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        $dataToCompare = [
            0 => [
                'id' => 1,
                'firstName' => 'Charles',
                'lastName' => 'Xavier',
                'job' => 'Professeur',
            ],
            1 => [
                'id' => 2,
                'firstName' => 'Jimmy',
                'lastName' => 'Hendrix',
                'job' => 'Musicien',
            ],
            2 => [
                'id' => 3,
                'firstName' => 'Dark',
                'lastName' => 'Vador',
                'job' => 'Sith',
            ],
            3 => [
                'id' => 4,
                'firstName' => 'Bruce',
                'lastName' => 'Wayne',
                'job' => 'Milliardaire',
            ],
        ];

        $this->assertSame($dataToCompare, json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testShowReturnResponseStatus()
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
