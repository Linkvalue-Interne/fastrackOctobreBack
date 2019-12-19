<?php


namespace App\Component\builder;

use App\Component\retrieveAll\PartnerRetriever;
use App\Entity\Partner;
use App\form\PartnerType;
use Symfony\Component\Form\FormFactoryInterface;

class PartnerBuilder
{
    use HandleErrorFormTrait;

    /** @var FormFactoryInterface  */
    private $formFactory;

    /** @var PartnerRetriever  */
    private $partnerRetriever;

    public function __construct(FormFactoryInterface $formFactory, PartnerRetriever $partnerRetriever)
    {
        $this->formFactory = $formFactory;
        $this->partnerRetriever = $partnerRetriever;
    }

    public function buildWithForm(array $data, int $partnerId = null): Partner
    {
        $partner =  is_null($partnerId) ? new Partner() : $this->partnerRetriever->getOne($partnerId);

        $form = $this->formFactory
            ->create(PartnerType::class, $partner)
            ->submit($data);

        $this->validateForm($form);

        return $partner;
    }
}
