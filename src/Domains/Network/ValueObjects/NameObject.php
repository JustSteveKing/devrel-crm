<?php

declare(strict_types=1);

namespace Domains\Network\ValueObjects;

use function json_encode;

final readonly class NameObject
{
    public function __construct(
        public string $first,
        public null|string $middle,
        public null|string $last,
        public string $preferred,
    ) {
    }

    public function __toArray(): array
    {
        return [
            'first' => $this->first,
            'middle' => $this->middle,
            'last' => $this->last,
            'preferred' => $this->preferred,
        ];
    }

    public function __toString(): string
    {
        return json_encode(
            value: ['name' => $this->__toArray()],
            flags: JSON_THROW_ON_ERROR,
        );
    }
}
