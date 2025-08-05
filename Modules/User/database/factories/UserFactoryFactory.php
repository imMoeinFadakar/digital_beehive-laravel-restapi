<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;

class UserFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "email" => "moeinfadakar@gmail.com",
            "password" => Hash::make("moeinfadakar"),
            "first_name" => "moein",
            "last_name" => "fadakar"
        ];
    }
}

