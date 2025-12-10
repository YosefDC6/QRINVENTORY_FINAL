<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin QRInventory',
            'email' => 'admin@qri.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
