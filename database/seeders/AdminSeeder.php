<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'shahid',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ensure to use a strong password in production
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
