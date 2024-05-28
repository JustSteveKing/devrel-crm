<?php

declare(strict_types=1);

namespace Infrastructure\Entities;

abstract class DomainEntity
{
    abstract public function toArray(): array;
}
