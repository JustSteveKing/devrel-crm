<?php

declare(strict_types=1);

namespace App\Http\Resources;

use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property-read DateTimeInterface $resource
 */
final class DateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $date = Carbon::parse(
            time: $this->resource,
        );

        return [
            'human' => $date->diffForHumans(),
            'string' => $date->toDateTimeString(),
            'local' => $date->toDateTimeLocalString(),
            'timestamp' => $date->timestamp,
        ];
    }
}
