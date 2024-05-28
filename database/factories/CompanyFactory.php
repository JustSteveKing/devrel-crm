<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class CompanyFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Company::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'logo' => $this->faker->imageUrl(),
            'website' => $this->faker->url(),
            'email' => $this->faker->unique()->companyEmail(),
            'industry' => $this->faker->word(),
            'description' => $this->faker->realText(),
            'socials' => [
                'twitter' => $username = $this->faker->userName(),
                'linkedin' => $username,
                'github' => $username,
                'youtube' => $username,
            ],
            'user_id' => User::factory(),
        ];
    }
}
