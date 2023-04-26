<?php

namespace App\Customers\Message;

use App\Customers\Entity\User;
use Symfony\Component\Form\FormInterface;

final class UserRegistration
{
    public function __construct(public User $user, public FormInterface $form)
    {

    }
}
