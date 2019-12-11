<?php


namespace App\Tests\Large\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SkillControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = $this->createClient();
    }

    public function testListRoad()
    {
        $this->client->request('GET', '/api/skill');

        $expect = [
            "id" => 1 ,
            "name" => "Back" ,
            "subCategory" => [] ,
            "skills" => [
                [
                    "id" => 1 ,
                    "name" => "PHP" ,
                    "icon" => "php.jpg" ,
                ] ,
                [
                    "id" => 2 ,
                    "name" => "Symfony" ,
                    "icon" => "symfony.jpg" ,
                ] ,[
                    "id" => 3 ,
                    "name" => "Laravel" ,
                    "icon" => "laravel.jpg" ,
                ] ,
                [
                    "id" => 4 ,
                    "name" => "NodeJs" ,
                    "icon" => "nodejs.jpg" ,
                ] ,
                [
                    "id" => 5 ,
                    "name" => "Go" ,
                    "icon" => "go.jpg" ,
                ] ,
                [
                    "id" => 6 ,
                    "name" => "Java" ,
                    "icon" => "java.jpg" ,
                ] ,
                [
                    "id" => 7 ,
                    "name" => "Ruby" ,
                    "icon" => "ruby.jpg" ,
                ] ,
                [
                    "id" => 8 ,
                    "name" => "Python" ,
                    "icon" => "python.jpg" ,
                ] ,
                [
                    "id" => 9 ,
                    "name" => "Scala" ,
                    "icon" => "scala.jpg" ,
                ] ,
                [
                    "id" => 10 ,
                    "name" => "Rust" ,
                    "icon" => "rust.jpg" ,
                ] ,
                [
                    "id" => 11 ,
                    "name" => "Tests" ,
                    "icon" => "tests.jpg" ,
                ] ,
                [
                    "id" => 12 ,
                    "name" => "Lead" ,
                    "icon" => "lead.jpg" ,
                ] ,
                [
                    "id" => 13 ,
                    "name" => "Archi" ,
                    "icon" => "archi.jpg" ,
                ] ,
                [
                    "id" => 14 ,
                    "name" => "SSR" ,
                    "icon" => "ssr.jpg" ,
                ] ,
                [
                    "id" => 15 ,
                    "name" => "GraphQL" ,
                    "icon" => "graphql.jpg" ,
                ] ,
            ] ,
        ];

        $actual = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame($expect, $actual[0]);
        $this->assertGreaterThanOrEqual(1, count($actual));
    }
}
