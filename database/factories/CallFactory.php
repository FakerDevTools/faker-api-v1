<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Call;
use App\Models\Token;

class CallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Call::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'url' => fake()->url(),
            'ip' => fake()->word(),
            'token_id' => Token::factory(),
            'reasult' => fake()->randomElement(["success","token","route","demo"]),
        ];
    }
}
