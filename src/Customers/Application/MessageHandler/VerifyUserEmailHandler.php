<?php

declare(strict_types=1);

namespace App\Customers\Application\MessageHandler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Customers\Infrastructure\Symfony\Security\EmailVerifier;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Customers\Application\Message\VerifyUserEmail;

#[AsMessageHandler]
final class VerifyUserEmailHandler
{
    public function __construct(private EmailVerifier $emailVerifier)
    {

    }

    public function __invoke(VerifyUserEmail $verifyUserEmail): bool|VerifyEmailExceptionInterface
    {
        try {
            $this->emailVerifier->handleEmailConfirmation($verifyUserEmail->request, $verifyUserEmail->user);
            return true;
        } catch (VerifyEmailExceptionInterface $exception){
            return $exception;
        }
    }
}