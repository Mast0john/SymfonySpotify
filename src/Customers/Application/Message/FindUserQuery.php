<?php

declare(strict_types=1);

namespace App\Customers\Application\Message;

final class FindUserQuery
{
    public function __construct(public readonly int $id)
    {

    }
}
