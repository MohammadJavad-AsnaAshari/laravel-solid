<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => $this->getWeightedRandomRole(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    protected function getWeightedRandomRole(): string
    {
        $weights = [
            'user' => 80,
            'admin' => 18,
            'super_admin' => 2,
        ];

        $totalWeight = array_sum($weights);
        $randomValue = rand(1, $totalWeight);

        $cumulativeWeight = 0;
        foreach ($weights as $role => $weight) {
            $cumulativeWeight += $weight;
            if ($randomValue <= $cumulativeWeight) {
                return $role;
            }
        }

        return 'user'; // Fallback in case of unexpected behavior
    }
}
