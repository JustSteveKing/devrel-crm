<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Entities\DomainEntity;

abstract class Repository implements RepositoryInterface
{
    public function __construct(
        private null|Builder $query,
        private DatabaseManager $database,
    ) {
    }

    public function all(): Collection
    {
        return $this->query->get();
    }

    public function query(Builder $builder): Repository
    {
        $this->query = $builder;

        return $this;
    }

    public function find(string $id, array $with = []): null|object
    {
        return $this->query->with(
            relations: $with,
        )->findOrFail(
            id: $id,
        );
    }

    public function create(DomainEntity $entity, array $override = []): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->create(
                attributes: array_merge(
                    $entity->toArray(),
                    $override,
                ),
            ),
            attempts: 3,
        );
    }

    public function update(string $id, DomainEntity $entity): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->where(
                column: 'id',
                operator: '=',
                value: $id,
            )->update(
                values: $entity->toArray(),
            ),
            attempts: 3,
        );
    }

    public function delete(string $id): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->where(
                column: 'id',
                operator: '=',
                value: $id,
            )->delete(),
            attempts: 3,
        );
    }
}
