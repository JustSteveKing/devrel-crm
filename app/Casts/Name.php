<?php

declare(strict_types=1);

namespace App\Casts;

use App\DataObjects\NameObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

final class Name implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed<string,string> $value
     * @param array $attributes
     * @return NameObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): NameObject
    {
        return new NameObject(
            first: $attributes['first'],
            middle: $attributes['middle'],
            last: $attributes['last'],
            preferred: $attributes['preferred'],
        );
    }

    /**
     * @param Model $model
     * @param string $key
     * @param NameObject $value
     * @param array $attributes
     * @return array{first:string,middle:null|string,last:null|string,preferred:string}
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return [
            'first' => $value->first,
            'middle' => $value->middle,
            'last' => $value->last,
            'preferred' => $value->preferred,
        ];
    }
}
