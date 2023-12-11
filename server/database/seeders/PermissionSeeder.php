<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            'modul-role',
            'user-edit',
            'user-delete',
            'user-create',
            'user-list',
            'destination-edit',
            'destination-delete',
            'destination-create',
            'destination-list',
            'category-edit',
            'category-delete',
            'category-create',
            'category-list',
            'business-edit',
            'business-delete',
            'business-create',
            'business-list',
            'region-edit',
            'region-delete',
            'region-create',
            'region-list',
        ];

        foreach($permission as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
