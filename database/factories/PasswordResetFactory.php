<?php

namespace Database\Factories;

use App\Models\PasswordReset;
use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PasswordResetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PasswordReset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'resetable_id'   => User::query()->inRandomOrder()->value('id'),
            'resetable_type' => User::class,
            'reset_token'    => Hash::make(Str::random()),
        ];
    }
}
