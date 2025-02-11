<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Application;
use Carbon\Carbon;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

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
        // Cities
        $application= Application::factory()->create([
            'name' => 'Smart City',
            'token' => '1234567890',
            'image' => '',
            'user_id' => $user,
        ]);

        $application->users()->save($user);
        $user->application_id = $application->id;

        $application = Application::factory()->create([
            'name' => 'Second Application',
            'token' => '0987654321',
            'image' => '',
            'user_id' => $user,
        ]);

        $application->users()->save($user);

    }
}
