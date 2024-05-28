<?php

declare(strict_types=1);

namespace App\Casts;

use Domains\Network\ValueObjects\NameObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use JsonException;
use function is_string;
use function json_decode;
use function json_encode;

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
        $name = json_decode(
            json: $value,
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );

        return new NameObject(
            first: $name['name']['first'],
            middle: $name['name']['middle'],
            last: $name['name']['last'],
            preferred: $name['name']['preferred'],
        );
    }

    /**
     * @param Model $model
     * @param string $key
     * @param NameObject|string $value
     * @param array $attributes
     * @return string
     * @throws JsonException
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (is_string($value)) {
            return $value;
        }

        if ( ! $value instanceof NameObject) {
            throw new InvalidArgumentException(
                message: 'Value must be an instance of Name Object',
            );
        }

        return json_encode(
            value: [
                $key => $value,
            ],
            flags: JSON_THROW_ON_ERROR,
        );
    }
}
