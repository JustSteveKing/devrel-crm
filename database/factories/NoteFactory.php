<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class NoteFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Note::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'content' => $this->faker->realText(
                maxNbChars: $this->faker->numberBetween(
                    int1: 500,
                    int2: 2_000,
                ),
            ),
            'attachable_id' => Contact::factory(),
            'attachable_type' => Contact::class,
            'user_id' => User::factory(),
        ];
    }
}
