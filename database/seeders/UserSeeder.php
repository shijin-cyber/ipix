<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('userpassword'),
        ]);
    }
}