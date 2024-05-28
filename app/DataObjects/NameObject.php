<?php

declare(strict_types=1);

namespace App\DataObjects;

final readonly class NameObject
{
    public function __construct(
        public string $first,
        public null|string $middle,
        public null|string $last,
        public string $preferred,
    ) {
    }
}
