<?php


namespace App\Component\handler;

trait FormatDataTrait
{
    /**
     * @param array $data
     * @param array $authorizedKey
     * @return array
     */
    public function formatData(array $data, array $authorizedKey): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $authorizedKey)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
