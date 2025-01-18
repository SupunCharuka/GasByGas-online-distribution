<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('model_has_roles')->insert(
            [
                //Admin
                [
                    'role_id' => '1',
                    'model_id' => '1',
                    'model_type' => 'App\Models\User',
                ],
                
                //User
                [
                    'role_id' => '2',
                    'model_id' => '2',
                    'model_type' => 'App\Models\User',
                ],
            ]
        );
    }
}
