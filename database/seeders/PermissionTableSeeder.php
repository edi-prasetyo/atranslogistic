<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-read',
            'user-create',
            'user-update',
            'user-delete',
            'option-read',
            'option-update',
            'role-read',
            'role-create',
            'role-update',
            'role-delete',
            'post-read',
            'post-create',
            'post-update',
            'post-delete',
            'category-read',
            'category-create',
            'category-update',
            'category-delete',
            'tag-read',
            'tag-create',
            'tag-update',
            'tag-delete',
            'page-read',
            'page-create',
            'page-update',
            'page-delete',
            'province-read',
            'province-create',
            'province-update',
            'province-delete',
            'city-read',
            'city-create',
            'city-update',
            'city-delete',
            'routes-read',
            'routes-create',
            'routes-update',
            'routes-delete',
            'vehicle-read',
            'vehicle-create',
            'vehicle-update',
            'vehicle-delete',
            'order-read',
            'order-create',
            'order-update',
            'order-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
