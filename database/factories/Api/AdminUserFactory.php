<?php

namespace Database\Factories\Api;

use App\Models\Api\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randRole = Role::query()->where('id', '!=', 1)->inRandomOrder()->first();



        return [
            'username' => fake()->unique()->word,
            'password' => bcrypt('password'),
            'admin_user_id' => 0,
            'role_id' => $randRole,
            'start_time' => now(),
            'end_time' => now()->addYear(),
        ];
    }
}
