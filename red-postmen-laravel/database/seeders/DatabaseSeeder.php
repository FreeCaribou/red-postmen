<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userCoach = User::firstOrCreate(
            ['email' => 'coach@freecaribou.net'],
            [
                'name' => 'Red Coach',
                'password' => 'helloworld',
                'email_verified_at' => now(),
                'role' => 'coach'
            ]
        );

        $userAdmin = User::firstOrCreate(
            ['email' => 'redpostmen@freecaribou.net'],
            [
                'name' => 'Red Admin',
                'password' => 'helloworld',
                'email_verified_at' => now(),
                'role' => 'admin'
            ]
        );

        $userSimple = User::firstOrCreate(
            ['email' => 'johndoe@freecaribou.net'],
            [
                'name' => 'Johndoe',
                'password' => 'helloworld',
                'email_verified_at' => now(),
                'role' => 'user'
            ]
        );
    }
}
