<?php


namespace App\Component\handler;

trait FormatDataTrait
{
    /**
     * @param array $data
     * @return array
     */
    public function formatData(array $data): array
    {
        $result = [];

        $authorizedKey = [
            'firstName',
            'lastName',
            'job',
            'email',
            'phoneNumber',
            'experience',
            'customer',
            'project',
        ];

        foreach ($data as $key => $value) {
            if (in_array($key, $authorizedKey)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
