<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\Email;
use App\Casts\Name;
use App\Models\Concerns\HasNotes;
use App\Observers\ContactObserver;
use Carbon\CarbonInterface;
use Domains\Network\ValueObjects\NameObject;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property NameObject $name
 * @property Email $email
 * @property AsCollection $socials
 * @property null|string $role
 * @property null|string $pronouns
 * @property null|string $company_id
 * @property string $user_id
 * @property null|CarbonInterface $birthday
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Company $company
 * @property User $owner
 * @property Collection<Interaction> $interactions
 * @property Collection<Note> $notes
 */
#[ObservedBy(classes: ContactObserver::class)]
final class Contact extends Model
{
    use HasFactory;
    use HasNotes;
    use HasUlids;
    use Notifiable;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'socials',
        'role',
        'pronouns',
        'company_id',
        'user_id',
        'birthday',
    ];

    /** @return BelongsTo<Company> */
    public function company(): BelongsTo
    {
        return $this->belongsTo(
            related: Company::class,
            foreignKey: 'company_id',
        );
    }

    /** @return BelongsTo<User> */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany<Interaction> */
    public function interactions(): HasMany
    {
        return $this->hasMany(
            related: Interaction::class,
            foreignKey: 'contact_id',
        );
    }

    /** @return array<string,mixed> */
    protected function casts(): array
    {
        return [
            'name' => Name::class,
            'email' => Email::class,
            'socials' => AsCollection::class,
            'birthday' => 'date',
        ];
    }
}
