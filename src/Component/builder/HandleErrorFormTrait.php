<?php


namespace App\Component\builder;

use App\CustomException\ValidatorException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

trait HandleErrorFormTrait
{
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

            throw new ValidatorException($errors, Response::HTTP_BAD_REQUEST);
        }
    }
}
