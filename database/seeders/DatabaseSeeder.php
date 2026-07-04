<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Owner Barokah',
            'email' => 'owner@barokah.com',
            'role' => 'owner',
            'password' => Hash::make('barokahjaya'),
        ]);

        User::create([
            'name' => 'Pelanggan Barokah',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('jayajaya'),
        ]);
    }
}