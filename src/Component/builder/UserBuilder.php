<?php

namespace App\Component\builder;

use App\Entity\User;
use App\form\UserType;
use Symfony\Component\Form\FormFactoryInterface;

class UserBuilder
{
    use HandleErrorFormTrait;

    /** @var FormFactoryInterface */
    private $formFactory;

    /**
     * UserBuilder constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function buildUser(array $data): User
    {
        $user = new User();

        $form = $this->formFactory
            ->create(UserType::class, $user)
            ->submit($data);

        $this->validateForm($form);

        return $user;
    }
}
