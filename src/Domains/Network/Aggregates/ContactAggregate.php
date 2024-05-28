<?php

declare(strict_types=1);

namespace Domains\Network\Aggregates;

use App\Models\Contact as ContactModel
use Domains\Network\Entities\ContactEntity;
use Domains\Network\Events\CompanyEntity;

final readonly class ContactAggregate
{
    public function __construct(
        private ContactEntity $contact,
        private null|CompanyEntity $company,
    ) {
    }

    public function company(): null|CompanyEntity
    {
        return $this->company;
    }

    public function contact(): ContactEntity
    {
        return $this->contact;
    }

    public static function fromContactModel(ContactModel $contact): ContactAggregate
    {
        return new ContactAggregate(
            contact: ContactEntity::fromEloquent(
                contact: $contact,
            ),
            company: CompanyEntity::fromEloquent(
                company: $contact->company,
            ),
        );
    }
}
