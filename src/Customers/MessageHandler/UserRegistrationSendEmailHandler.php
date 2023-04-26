<?php

namespace App\Customers\MessageHandler;

use App\Customers\Message\UserRegistration;
use App\Customers\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Address;

#[AsMessageHandler(priority: 16)]
final class UserRegistrationSendEmailHandler
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    public function __invoke(UserRegistration $message)
    {
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $message->user,
            (new TemplatedEmail())
                ->from(new Address('registration@moussaka.local', 'moussaka'))
                ->to($message->user->getEmail())
                ->subject('Merci de confirmer votre email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
    }
}