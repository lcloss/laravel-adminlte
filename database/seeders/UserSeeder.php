<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'verified'          => true,
            'verified_at'       => now(),
            'status'            => 'A',
            'approved'          => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
        DB::table('users')->insert([
            'name'              => 'Test User',
            'email'             => 'user@user.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'verified'          => true,
            'verified_at'       => now(),
            'status'            => 'S',
            'approved'          => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
