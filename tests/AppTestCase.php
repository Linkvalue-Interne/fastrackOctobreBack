<?php


namespace App\Tests;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTestCase extends WebTestCase
{
    protected static $entities = [];

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function saveEntity($JsonData)
    {
        $data = json_decode($JsonData, true);

        $entity = self::$kernel->getContainer()->get(PartnerRepository::class)->find($data['id']);

        self::$entities[] = $entity;
    }

    protected static function cleanUpDataBase()
    {
        /** @var  EntityManager $entityManager */
        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        foreach (self::$entities as $entity) {
            $entityAttached = $entityManager->merge($entity);
            $entityManager->remove($entityAttached);
        }
        $entityManager->flush();

        foreach (self::$entities as $entity) {
            self::assertNull($entityManager->find(Partner::class, $entity->getId()));
        }
    }

    public static function tearDownAfterClass(): void
    {
        self::cleanUpDataBase();
    }
}
