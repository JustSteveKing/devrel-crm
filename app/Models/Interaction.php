<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Interactions\Type;
use App\Models\Concerns\HasNotes;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property Type $type
 * @property null|string $summary
 * @property null|string $next
 * @property string $contact_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Contact $contact
 * @property Collection<Note> $notes
 */
final class Interaction extends Model
{
    use HasFactory;
    use HasNotes;
    use HasUlids;

    /** @var array<int,string> */
    protected $fillable = [
        'type',
        'summary',
        'next',
        'contact_id',
    ];

    /** @return BelongsTo<Contact> */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(
            related: Contact::class,
            foreignKey: 'contact_id',
        );
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'type' => Type::class,
        ];
    }
}
