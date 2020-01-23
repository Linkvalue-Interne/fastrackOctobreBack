<?php

namespace App\Tests\Large\Authentication;

use App\Tests\AppTestCase;

class LoginTest extends AppTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = $this->createClient();
    }

    public function testLoginUnauthorized(): void
    {
        $this->client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => 'badUsername',
                'password' => 'BadPassword',
            ])
        );

        $this->assertSame(401, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $this->assertSame('{"code":401,"message":"Invalid credentials."}', $this->client->getResponse()->getContent());
    }

    public function testLoginSuccess(): void
    {
        $this->client->request(
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

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }
}
