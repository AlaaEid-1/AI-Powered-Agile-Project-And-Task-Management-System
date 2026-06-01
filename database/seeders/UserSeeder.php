<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'Alaa Eid',
            'username' => 'alaa_eid',
            'email' => 'Alaa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => null,
            'country_code' => 'PS',
            'timezone' => 'UTC',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'menna eid',
            'username' => 'menna_eid',
            'email' => 'menna@example.net',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => null,
            'country_code' => 'PS',
            'timezone' => 'UTC',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
