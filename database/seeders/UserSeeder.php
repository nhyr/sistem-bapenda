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
            'name' => 'Admin Bapenda',
            'email' => 'admin@bapenda.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'unit_kerja' => 'Admin Sistem',
        ]);

        User::create([
            'name' => 'Staff Pelayanan',
            'email' => 'staff@bapenda.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'unit_kerja' => 'Pelayanan',
        ]);
    }
}