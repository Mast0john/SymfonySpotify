<?php

namespace App\MessageHandler;

use App\Message\UserRegistration;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UserRegistrationSendEmailHandler
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
        
    }

    public function __invoke(UserRegistration $message)
    {
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('registration@moussaka.local', 'moussaka'))
                    ->to($user->getEmail())
                    ->subject('Merci de confirmer votre email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
    }
}
