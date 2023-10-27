<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Create a new user';

    public function handle()
    {
        $user = User::where('email', 'marcus@marcus.com')->first();

        if (!$user) {
            $user = new User;
            $user->name = 'Marcus';
            $user->email = 'marcus@marcus.com';
            $user->password = bcrypt('manaus');
            $user->save();

            $token = $user->createToken('NomeDoToken')->plainTextToken;

            $this->info('User created successfully.');
            $this->info('Token: ' . $token);
        } else {
            $this->info('User already exists.');
        }
    }
}
