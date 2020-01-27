<?php


namespace App\Component\retrieveAll;

use App\Repository\UserRepository;

class UserRetriever
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * UserRetriever constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->userRepository->findAll() ?: [];
    }

    /**
     * @param int $id
     * @return array|object|null
     */
    public function getOne(int $id)
    {
        return $this->userRepository->findOneBy(['id' => $id]) ?? [];
    }
}
