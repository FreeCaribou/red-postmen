<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * Artisans command to create an admin, the only way to doing that will be like that
 */
class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('We will create a new admin for the app');
        $email = $this->ask('What is the email of the new admin?', 'admin@redpostmen.net');
        $this->info('Ok, ' . $email);
        $name = $this->ask('And his name?', $email);
        $this->info('Ok, ' . $name);
        $password = $this->secret('And now type a password please (it will be hidden in the console');

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => $password,
                'email_verified_at' => now(),
                'role' => 'admin'
            ]
        );
        $this->info('The admin is now created !');
    }
}
