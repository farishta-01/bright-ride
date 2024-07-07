<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Saad',
                'username' => 'saad',
                'email' => 'bsaad955@gmail.com',
                'password' => Hash::make('80868526'), // Ensure to use a strong password in production
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ali',
                'username' => 'ali',
                'email' => 'ali@example.com',
                'password' => Hash::make('password123'), // Ensure to use a strong password in production
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara',
                'username' => 'sara',
                'email' => 'sara@example.com',
                'password' => Hash::make('securepassword'), // Ensure to use a strong password in production
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

    }
}
