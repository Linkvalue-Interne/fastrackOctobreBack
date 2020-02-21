<?php


namespace App\Tests\Controller;

use App\Tests\AppTestCase;
use Symfony\Component\HttpFoundation\Response;

class PartnerControllerTest extends AppTestCase
{
    private $client;

    protected function setUp(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => 'tester@link-value.fr',
                'password' => 'password',
            ])
        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        $this->client = $client;
    }

    public function testListWithoutParameters()
    {
        $this->client->request('GET', '/api/partner');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        $dataToCompare = [
            'id' => 2,
            'firstName' => 'Jimmy',
            'lastName' => 'Hendrix',
            'job' => 'Musicien',
            'avatar' => 'cat4.jpg',
            'favorites' => [
                [
                    'id' => 1,
                    'name' => 'PHP',
                    'icon' => 'php.jpg',
                ],
                [
                    'id' => 2,
                    'name' => 'Symfony',
                    'icon' => 'symfony.jpg',
                ],
                [
                    'id' => 3,
                    'name' => 'Laravel',
                    'icon' => 'laravel.jpg',
                ]
            ],
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
            'favorites' => [
                [
                    'id' => 1,
                    'name' => 'PHP',
                    'icon' => 'php.jpg',
                ],
                [
                    'id' => 2,
                    'name' => 'Symfony',
                    'icon' => 'symfony.jpg',
                ],
                [
                    'id' => 3,
                    'name' => 'Laravel',
                    'icon' => 'laravel.jpg',
                ]
            ],
            'skills' => [
                [
                    'id' => 1,
                    'level' => 30,
                ],
                [
                    'id' => 2,
                    'level' => 45,
                ],
                [
                    'id' => 3,
                    'level' => 13,
                ],
                [
                    'id' => 4,
                    'level' => 56,
                ],
            ],
        ]
        ;

        $this->assertSame($dataToCompare, json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testDeleteExistId()
    {
        $expect = '{"statusCode":200}';

        $this->client->request('DELETE', '/api/partner/1');

        $this->assertSame($expect, $this->client->getResponse()->getContent());
        $this->assertJson($this->client->getResponse()->getContent());
    }

    public function testDeleteNotExistId()
    {
        $expect = '{"status":404,"message":"Invalid argument"}';

        $this->client->request('DELETE', '/api/partner/10');

        $this->assertSame($expect, $this->client->getResponse()->getContent());
        $this->assertJson($this->client->getResponse()->getContent());
    }

    public function testCreateSuccess()
    {
        $content = [
            "firstName" => "alex",
            "lastName" => "tual",
            "job" => "dev",
            "email" => "tual@link-value.fr",
            "phoneNumber" => "0101",
            "experience" => 10,
            "customer" => "client",
            "avatar" => "image.jpg",
        ];

        $expect = '{"id":6,"firstName":"alex","lastName":"tual","job":"dev","email":"tual@link-value.fr","phoneNumber":"0101","experience":10,"customer":"client","project":null,"avatar":"image.jpg","favorites":[],"skills":[]}';

        $this->client->request('POST', '/api/partner', $content);

        $actual = $this->client->getResponse()->getContent();

        $this->saveEntity($actual);

        $this->assertSame($expect, $actual);
    }

    public function testCreateWrongKey()
    {
        $content = [
            "badKey" => "alex",
        ];

        $expect = '{"status":400,"message":"the element with key \u0022firstName\u0022 is required"}';

        $this->client->request('POST', '/api/partner', $content);

        $this->assertSame($expect, $this->client->getResponse()->getContent());
        $this->assertJson($this->client->getResponse()->getContent());
    }
}
