<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Contact;
use Domains\Network\Entities\ContactEntity;
use Domains\Network\Events\ContactCreated;
use Illuminate\Events\Dispatcher;

final readonly class ContactObserver
{
    public function __construct(
        private Dispatcher $events,
    ) {
    }

    public function created(Contact $contact): void
    {
        $this->events->dispatch(
            event: new ContactCreated(
                contact: ContactEntity::fromEloquent(
                    contact: $contact,
                ),
            ),
        );
    }
}
