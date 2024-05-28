<?php

declare(strict_types=1);

namespace App\Casts;

use Domains\Network\ValueObjects\EmailObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use function json_decode;
use function json_encode;

final class Email implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): EmailObject
    {
        $email = json_decode(
            json: $value,
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );

        return new EmailObject(
            email: $email['email'],
        );
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return json_encode(
            value: [
                'email' => $value,
            ],
        );
    }
}
