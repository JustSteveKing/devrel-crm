<?php

declare(strict_types=1);

namespace Domains\Network\Events;

use App\Models\Company;

final readonly class CompanyEntity
{
    public function __construct(
        public string $name,
        public null|string $logo,
        public null|string $website,
        public null|string $email,
        public null|string $industry,
        public null|string $description,
        public null|array $socials,
    ) {
    }

    public static function fromEloquent(Company $company): CompanyEntity
    {
        return new CompanyEntity(
            name: $company->name,
            logo: $company->logo,
            website: $company->website,
            email: $company->email,
            industry: $company->industry,
            description: $company->description,
            socials: $company->socials?->toArray(),
        );
    }
}
