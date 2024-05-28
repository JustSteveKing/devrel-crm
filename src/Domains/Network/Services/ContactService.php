<?php

declare(strict_types=1);

namespace Domains\Network\Services;

use App\Models\Contact;
use Domains\Network\Aggregates\ContactAggregate;
use Domains\Network\Entities\ContactEntity;
use Domains\Network\Events\CompanyEntity;
use Domains\Network\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final readonly class ContactService
{
    public function __construct(
        private ContactRepository $repository,
    ) {
    }

    public function query(Builder $builder): ContactService
    {
        $this->repository->query(
            builder: $builder,
        );

        return $this;
    }

    public function aggregate(string $id): ContactAggregate
    {
        /** @var Contact $contact */
        $contact = $this->repository->find(
            id: $id,
            with: ['company'],
        );

        return new ContactAggregate(
            contact: ContactEntity::fromEloquent(
                contact: $contact,
            ),
            company: CompanyEntity::fromEloquent(
                company: $contact->company,
            ),
        );
    }

    /**
     * @return Collection<ContactEntity>
     */
    public function all(): Collection
    {
        return $this->repository->all()->map(
            ContactEntity::fromEloquent(...)
        );
    }

    public function create(ContactEntity $contact, string $user): void
    {
        $this->repository->create(
            entity: $contact,
            override: [
                'user_id' => $user,
            ]
        );
    }

    public function update(string $id, ContactEntity $contact): void
    {
        $this->repository->update(
            id: $id,
            entity: $contact,
        );
    }

    public function delete(string $id): void
    {
        $this->repository->delete(
            id: $id,
        );
    }
}
