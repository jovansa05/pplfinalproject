<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin KotaKita',
                'email' => 'admin@kotakita-surabaya.id',
                'password' => Hash::make('Admin123!'),
                'kecamatan_id' => 1,
                'kelurahan_id' => 1,
                'role' => 'admin',
            ],
            [
                'name' => 'Admin DLH Surabaya',
                'email' => 'dlh@kotakita-surabaya.id',
                'password' => Hash::make('DLH2025!'),
                'kecamatan_id' => 7, // Genteng (pusat kota)
                'kelurahan_id' => 27,
                'role' => 'admin',
            ],
            [
                'name' => 'Admin Kecamatan Gubeng',
                'email' => 'gubeng@kotakita-surabaya.id',
                'password' => Hash::make('Gubeng2025!'),
                'kecamatan_id' => 8,
                'kelurahan_id' => 33,
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            DB::table('users')->insert([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => $admin['password'],
                'kecamatan_id' => $admin['kecamatan_id'],
                'kelurahan_id' => $admin['kelurahan_id'],
                'role' => $admin['role'],
                'email_verified_at' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}