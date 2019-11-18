<?php


namespace App\Component\viewer;

use App\Component\retrieveAll\PartnerRetriever;
use Symfony\Component\HttpFoundation\Request;

class PartnerViewer
{
    /** @var PartnerRetriever  */
    private $retriever;

    public function __construct(PartnerRetriever $retriever)
    {
        $this->retriever = $retriever;
    }

    /**
 * @return array
 */
    public function formatList(): array
    {
        $partnerList = [];

        foreach ($this->retriever->getAll() as $partner) {
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
     * @param int $id
     * @return array
     */
    public function formatShow(int $id): array
    {
        $data  = $this->retriever->getOne($id);

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
