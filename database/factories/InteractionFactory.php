<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Interactions\Type;
use App\Models\Contact;
use App\Models\Interaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class InteractionFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Interaction::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'type' => Type::Other,
            'summary' => $this->faker->realText(),
            'next' => null,
            'contact_id' => Contact::factory(),
        ];
    }
}
