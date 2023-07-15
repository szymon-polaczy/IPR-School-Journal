<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Permission::create(['name' => 'create-classes']);
        Permission::create(['name' => 'edit-classes']);
        Permission::create(['name' => 'delete-classes']);

        Permission::create(['name' => 'create-rooms']);
        Permission::create(['name' => 'edit-rooms']);
        Permission::create(['name' => 'delete-rooms']);

        Permission::create(['name' => 'create-teachers']);
        Permission::create(['name' => 'edit-teachers']);
        Permission::create(['name' => 'delete-teachers']);

        Permission::create(['name' => 'create-students']);
        Permission::create(['name' => 'edit-students']);
        Permission::create(['name' => 'delete-students']);

        $adminRole = Role::create(['name' => 'Admin']);
        $teacherRole = Role::create(['name' => 'Teacher']);
        $studentRole = Role::create(['name' => 'Student']);

        $adminRole->givePermissionTo([
            'create-classes',
            'edit-classes',
            'delete-classes',

            'create-rooms',
            'edit-rooms',
            'delete-rooms',

            'create-teachers',
            'edit-teachers',
            'delete-teachers',

            'create-students',
            'edit-students',
            'delete-students',
        ]);
    }
}