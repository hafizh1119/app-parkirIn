<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@parkirin.com'
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'customer@parkirin.com'
            ],
            [
                'name' => 'Customer',
                'password' => Hash::make('password'),
                'role' => 'customer'
            ]
        );
    }
}