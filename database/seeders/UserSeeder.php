<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                //Admin
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => bcrypt('password'),
                ],
                
                //User 
                [
                    'name' => 'User',
                    'email' => 'user@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => bcrypt('password'),
                ],
             
            ]
        );
    }
}
