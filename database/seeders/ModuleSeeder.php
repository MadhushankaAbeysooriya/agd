<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insertOrIgnore([
            [
                'name' => 'Role',
                'details' => 'role model',
            ],
            [
                'name' => 'User',
                'details' => 'user model',
            ],
        ]);
    }
}
