<?php

declare(strict_types=1);

namespace App\Customers\MessageHandler;

use App\Customers\Message\UserRegistration;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(priority: 64)]
final class PrepareArtistUser
{
    public function __invoke(UserRegistration $userRegistration)
    {
        if ($userRegistration->form->get('artist')->getData()) {
            $userRegistration->user->setRoles(['ROLE_ARTIST']);
        }
    }
}