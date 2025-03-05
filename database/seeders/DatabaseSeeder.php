<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Faker\Generator;

use App\Models\Application;
use App\Models\Token;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $faker = app(Generator::class);

        // **************************************************
        // **************************************************
        // **************************************************
        // Users
        $user = User::factory()->create([
            'first' => 'Doe',
            'last' => 'Thomas',
            'session_id' => rand(1000000000, 9999999999),
            'github_username' => '',
            'email' => 'janedoe@email.com',
            'password' => '$2y$10$1oyAGH/Ffv.O/YPzZtJlR.PdmutrNiR5OAyyV4llUUno6GGR9fMK.',
            'admin' => 0,
        ]);

        $user = User::factory()->create([
            'first' => 'Adam',
            'last' => 'Thomas',
            'session_id' => rand(1000000000, 9999999999),
            'github_username' => '',
            'email' => 'thomasadam83@hotmail.com',
            'password' => '$2y$10$1oyAGH/Ffv.O/YPzZtJlR.PdmutrNiR5OAyyV4llUUno6GGR9fMK.',
            'admin' => 1,
        ]);

        // **************************************************
        // **************************************************
        // **************************************************
        // Applications and Tokens
        $application= Application::factory()->create([
            'name' => 'Smart City Application',
            'image' => '',
            'user_id' => $user,
        ]);

        $application->users()->save($user);
        $user->application_id = $application->id;

        $token = Token::factory()->create([
            'name' => 'Token 1',
            'hash' => '12345678901234567890',
            'application_id' => $application,
            'status' => 'active',
        ])->save();

        $token = Token::factory()->create([
            'name' => 'Token 2',
            'hash' => $faker->regexify('[A-Z0-9]{20}'),
            'application_id' => $application,
            'status' => 'active',
        ])->save();

        $application = Application::factory()->create([
            'name' => 'Second Application',
            'image' => '',
            'user_id' => $user,
        ]);

        $application->users()->save($user);

        $token = Token::factory()->create([
            'name' => 'Token 3',
            'hash' => $faker->regexify('[A-Z0-9]{20}'),
            'application_id' => $application,
            'status' => 'active',
        ])->save();

    }
}
