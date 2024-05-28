<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Domains\Network\Entities\ContactEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read ContactEntity $resource
 */
final class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email->email,
            'birthday' => new DateResource(
                resource: $this->resource->birthday,
            ),
            'socials' => $this->resource->socials,
            'role' => $this->resource->role,
        ];
    }
}
