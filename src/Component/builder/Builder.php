<?php


namespace App\Component\builder;

use App\Entity\Partner;
use App\form\PartnerType;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class Builder
{
    use HandleErrorFormTrait;

    /** @var FormFactoryInterface  */
    private $formFactory;

    private $logger;

    public function __construct(FormFactoryInterface $formFactory, LoggerInterface $logger)
    {
        $this->formFactory = $formFactory;
        $this->logger = $logger;
    }

    public function buildWithForm(array $data): Partner
    {
        $this->logger->debug('buildWithForm', $data);
        $partner = new Partner();

        $form = $this->formFactory
            ->create(PartnerType::class, $partner)
            ->submit($data);

        $this->logger->debug('buildWithForm_formIsValid', [$form->getErrors()]);

        $this->validateForm($form);

        return $partner;
    }
}
