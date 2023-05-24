<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata =
            [
                [
                    'username' => 'admin',
                    'fullname' => 'Admin One',
                    'role' => 'admin',
                    'email' => 'admin@gmail.com',
                    'image' => '/photo/admin.png',
                    'email_verified' => true,
                    'email_verified_at' => now(),
                    'verification_token' => Str::random(60),
                    'password' => Hash::make('admin12345')
                ],
                [
                    'username' => 'user',
                    'fullname' => 'User One',
                    'role' => 'user',
                    'email' => 'user@gmail.com',
                    'image' => '/photo/default.png',
                    'email_verified' => true,
                    'email_verified_at' => now(),
                    'verification_token' => Str::random(60),
                    'password' => Hash::make('user12345')
                ],
            ];
        foreach ($userdata as $key => $val) {
            User::create($val);
        }
    }
}
