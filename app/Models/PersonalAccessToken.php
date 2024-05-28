<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Laravel\Sanctum\PersonalAccessToken as SanctumToken;

final class PersonalAccessToken extends SanctumToken
{
    use HasUlids;
}
