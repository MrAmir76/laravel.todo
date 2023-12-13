<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::query()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'admin' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('admin')
        ]);
    }
}
