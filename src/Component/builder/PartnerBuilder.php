<?php


namespace App\Component\builder;

use App\Entity\Partner;
use App\form\PartnerType;
use Symfony\Component\Form\FormFactoryInterface;

class PartnerBuilder
{
    use HandleErrorFormTrait;

    /** @var FormFactoryInterface  */
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function buildWithForm(array $data, Partner $partner = null): Partner
    {
        $partner =  $partner ?: new Partner();

        $form = $this->formFactory
            ->create(PartnerType::class, $partner)
            ->submit($data);

        $this->validateForm($form);

        return $partner;
    }
}
