<?php

declare(strict_types=1);

namespace App\Customers\Infrastructure\Symfony\Model;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User 
{
    public function __construct(
        public readonly string $email,
        public readonly string $displayName 
    ) {}
}
