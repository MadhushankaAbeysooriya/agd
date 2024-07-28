<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('permissions')->insertOrIgnore([
            [
                'name' => 'role-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'role-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-team-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-team-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-team-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-team-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-category-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-category-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-category-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-category-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-category-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-category-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-category-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-category-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-court-delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'master-case-delete',
                'guard_name' => 'web',
            ],
        ]);
    }
}
