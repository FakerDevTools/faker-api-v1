<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Call;
use App\Models\Ip;
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
            'address' => fake()->word(),
            'ip_id' => Ip::factory(),
            'token_id' => Token::factory(),
            'result' => fake()->randomElement(["success","token","route","demo"]),
        ];
    }
}
