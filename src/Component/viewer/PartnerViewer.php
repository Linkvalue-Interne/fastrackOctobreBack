<?php


namespace App\Component\viewer;

class PartnerViewer
{
    /**
     * @param $data
     * @return array
     */
    public function formatList(array $data): array
    {
        $partnerList = [];

        foreach ($data as $partner) {
            $partnerList[] = [
                'id' => $partner->getId(),
                'firstName' => $partner->getFirstname(),
                'lastName' => $partner->getLastname(),
                'job' => $partner->getJob(),
                'avatar' => $partner->getAvatar(),
            ]
            ;
        }

        return $partnerList;
    }

    /**
     * @param $data
     * @return array
     */
    public function formatShow($data): array
    {
        return $partner = [
            'id' => $data->getId(),
            'firstName' => $data->getFirstName(),
            'lastName' => $data->getLastName(),
            'job' => $data->getJob(),
            'email' => $data->getEmail(),
            'phoneNumber' => $data->getPhoneNumber(),
            'experience' => $data->getExperience(),
            'customer' => $data->getCustomer(),
            'project' => $data->getProject(),
            'avatar' => $data->getAvatar(),
            ]
        ;
    }
}
