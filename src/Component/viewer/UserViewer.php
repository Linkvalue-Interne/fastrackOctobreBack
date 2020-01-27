<?php

namespace App\Component\viewer;

class UserViewer
{
    /**
     * @param array $data
     * @return array
     */
    public function formatList(array $data): array
    {
        $result = [];

        foreach ($data as $user) {
            $result[] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles()[0],
            ];
        }

        return $result;
    }
}
