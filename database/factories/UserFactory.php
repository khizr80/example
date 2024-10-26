<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'name' => $this->faker->name,
            'password' => bcrypt('password'), // Default password
            'role' => 'user', // Default role
        ];
    }
}
