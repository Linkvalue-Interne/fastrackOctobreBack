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
                0 => [
                    "id" => 1 ,
                    "name" => "PHP" ,
                    "icon" => "php.jpg" ,
                ] ,
                1 => [
                    "id" => 2 ,
                    "name" => "Symfony" ,
                    "icon" => "symfony.jpg" ,
                ] ,
                2 => [
                    "id" => 3 ,
                    "name" => "Laravel" ,
                    "icon" => "laravel.jpg" ,
                ] ,
                3 => [
                    "id" => 4 ,
                    "name" => "NodeJs" ,
                    "icon" => "nodejs.jpg" ,
                ] ,
                4 => [
                    "id" => 5 ,
                    "name" => "Go" ,
                    "icon" => "go.jpg" ,
                ] ,
                5 => [
                    "id" => 6 ,
                    "name" => "Java" ,
                    "icon" => "java.jpg" ,
                ] ,
                6 => [
                    "id" => 7 ,
                    "name" => "Ruby" ,
                    "icon" => "ruby.jpg" ,
                ] ,
                7 => [
                    "id" => 8 ,
                    "name" => "Python" ,
                    "icon" => "python.jpg" ,
                ] ,
                8 => [
                    "id" => 9 ,
                    "name" => "Scala" ,
                    "icon" => "scala.jpg" ,
                ] ,
                9 => [
                    "id" => 10 ,
                    "name" => "Rust" ,
                    "icon" => "rust.jpg" ,
                ] ,
                10 => [
                    "id" => 11 ,
                    "name" => "Tests" ,
                    "icon" => "tests.jpg" ,
                ] ,
                11 => [
                    "id" => 12 ,
                    "name" => "Lead" ,
                    "icon" => "lead.jpg" ,
                ] ,
                12 => [
                    "id" => 13 ,
                    "name" => "Archi" ,
                    "icon" => "archi.jpg" ,
                ] ,
                13 => [
                    "id" => 14 ,
                    "name" => "SSR" ,
                    "icon" => "ssr.jpg" ,
                ] ,
                14 => [
                    "id" => 15 ,
                    "name" => "GraphQL" ,
                    "icon" => "graphql.jpg" ,
                ] ,
            ] ,
        ];

        $actual = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame($expect, $actual[1]);
        $this->assertGreaterThanOrEqual(1, count($actual));
    }
}
