<?php


namespace App\Component\builder;

use App\Component\HandleErrorFormTrait;
use App\Entity\Partner;
use App\form\PartnerType;
use Symfony\Component\Form\FormFactoryInterface;

class Builder
{
    use HandleErrorFormTrait;

    /** @var FormFactoryInterface  */
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function buildWithForm(array $data): Partner
    {
        $partner = new Partner();

        $form = $this->formFactory
            ->create(PartnerType::class, $partner)
            ->submit($data);

        $this->validateForm($form);

        return $partner;
    }
}
