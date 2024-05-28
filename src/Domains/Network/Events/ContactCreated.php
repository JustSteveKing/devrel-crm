<?php

declare(strict_types=1);

namespace Domains\Network\Events;

use Domains\Network\Entities\ContactEntity;
use Infrastructure\Events\DomainEvent;

final class ContactCreated extends DomainEvent
{
    public function __construct(
        public readonly ContactEntity $contact,
    ) {
    }
}
