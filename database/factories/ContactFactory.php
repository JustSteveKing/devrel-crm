<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class ContactFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Contact::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => [
                'first' => $this->faker->firstName(),
                'middle' => $this->faker->firstName(),
                'last' => $this->faker->lastName(),
                'preferred' => $username = $this->faker->userName(),
            ],
            'email' => $this->faker->companyEmail(),
            'socials' => [
                'twitter' => $username,
                'linkedin' => $username,
                'github' => $username,
                'youtube' => $username,
            ],
            'role' => $this->faker->jobTitle(),
            'pronouns' => null,
            'company_id' => null,
            'user_id' => User::factory(),
            'birthday' => $this->faker->date(),
        ];
    }
}
