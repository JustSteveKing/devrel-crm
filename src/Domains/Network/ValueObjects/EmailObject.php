<?php

declare(strict_types=1);

namespace Domains\Network\ValueObjects;

final readonly class EmailObject
{
    public null|string $email;

    public function __construct(null|string $email)
    {
        if (null === $email) {
            $this->email = $email;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }

        // @todo Throw Exception
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
