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
        //Query Builder
        DB::table('users')->insert([
            'name' => 'Salam',
            'email' => 'asa@example.com',
            'email_verified_at' =>date('Y-m-d'),
            'password' => Hash::make('n123$'),//'n123$',
            'remember_token' => 'null', 
            'created_at' =>date('Y-m-d'),
            'updated_at' =>date('Y-m-d'),
        ]);
    }
}
