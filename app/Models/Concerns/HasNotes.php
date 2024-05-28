<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin Model
 */
trait HasNotes
{
    public function notes(): MorphMany
    {
        return $this->morphMany(
            related: Note::class,
            name: 'attachable',
        );
    }
}
