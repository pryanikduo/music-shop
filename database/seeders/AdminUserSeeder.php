<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@nota.ru'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin'),
                'role' => 'admin',
            ]
        );
    }
}