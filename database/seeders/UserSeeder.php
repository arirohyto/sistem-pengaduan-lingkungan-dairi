<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user - updateOrCreate agar tidak error jika sudah ada
        User::updateOrCreate(
            ['email' => 'admin@dairi.go.id'],
            [
                'name' => 'Administrator',
                'phone' => '0812345678',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Dummy masyarakat users
        User::updateOrCreate(
            ['email' => 'ari@example.com'],
            [
                'name' => 'Ari Rohyto',
                'phone' => '081234567890',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Santoso',
                'phone' => '085678901234',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}