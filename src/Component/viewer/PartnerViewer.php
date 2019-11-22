<?php


namespace App\Component\viewer;

use App\Entity\Partner;

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
     * @param Partner $partner
     * @return array
     */
    public function formatShow(Partner $partner): array
    {
        return [
            'id' => $partner->getId(),
            'firstName' => $partner->getFirstName(),
            'lastName' => $partner->getLastName(),
            'job' => $partner->getJob(),
            'email' => $partner->getEmail(),
            'phoneNumber' => $partner->getPhoneNumber(),
            'experience' => $partner->getExperience(),
            'customer' => $partner->getCustomer(),
            'project' => $partner->getProject(),
            'avatar' => $partner->getAvatar(),
            ]
        ;
    }
}
