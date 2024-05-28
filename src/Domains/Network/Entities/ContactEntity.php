<?php

declare(strict_types=1);

namespace Domains\Network\Entities;

use App\Models\Contact;
use DateTimeInterface;
use Domains\Network\ValueObjects\EmailObject;
use Domains\Network\ValueObjects\NameObject;
use Infrastructure\Entities\DomainEntity;

final class ContactEntity extends DomainEntity
{
    public function __construct(
        public NameObject $name,
        public EmailObject $email,
        public null|array $socials,
        public null|string $role,
        public null|string $pronouns,
        public null|DateTimeInterface $birthday,
        public null|string $id = null,
    ) {
    }

    public static function fromEloquent(Contact $contact): ContactEntity
    {
        return new ContactEntity(
            name: $contact->name,
            email: $contact->email,
            socials: $contact->socials?->toArray(),
            role: $contact->role,
            pronouns: $contact->pronouns,
            birthday: $contact->birthday,
            id: $contact->id,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => (string) $this->name,
            'email' => $this->email,
            'socials' => $this->socials,
            'role' => $this->role,
            'pronouns' => $this->pronouns,
            'birthday' => $this->birthday,
        ];
    }
}
