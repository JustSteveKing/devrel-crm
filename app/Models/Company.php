<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property string $name
 * @property null|string $logo
 * @property null|string $website
 * @property null|string $email
 * @property null|string $industry
 * @property null|string $description
 * @property null|AsCollection $socials
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $user
 */
final class Company extends Model
{
    use HasFactory;
    use HasUlids;
    use Notifiable;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'logo',
        'website',
        'email',
        'industry',
        'description',
        'socials',
        'user_id',
    ];

    /** @return BelongsTo<User> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'socials' => AsCollection::class,
        ];
    }
}
