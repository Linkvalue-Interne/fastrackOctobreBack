<?php


namespace App\Component\builder;

use App\CustomException\ValidatorException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

trait HandleErrorFormTrait
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param FormInterface $form
     */
    public function validateForm(FormInterface $form): void
    {
        if (!$form->isValid()) {
            $errors = [];

            foreach ($form->getErrors(true) as $error) {
                $errors[$error->getOrigin()->getName()] = $error->getMessage();
            }
            $this->logger->debug('formIsNotValid', [$errors]);

            throw new ValidatorException($errors, Response::HTTP_BAD_REQUEST);
        }
        $this->logger->debug('formIsValid', [true]);
    }
}
