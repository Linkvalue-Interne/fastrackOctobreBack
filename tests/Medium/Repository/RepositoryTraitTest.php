<?php


namespace App\Tests\Medium\Repository;

trait RepositoryTraitTest
{
    protected static $kernel;

    public function setUp(): void
    {
        parent::setUp();
        self::$kernel = self::bootKernel();
    }

    public function initialState($entity)
    {
        $entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $entity  = $entityManager->merge($entity);
        $entityManager->remove($entity);
        $entityManager->flush();
    }
}
