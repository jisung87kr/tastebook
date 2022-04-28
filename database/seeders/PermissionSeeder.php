<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit own posts']);
        Permission::create(['name' => 'edit all posts']);
        Permission::create(['name' => 'delete own posts']);
        Permission::create(['name' => 'delete any posts']);
        Permission::create(['name' => 'view unpublished posts']);

        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'edit own comments']);
        Permission::create(['name' => 'edit all comments']);
        Permission::create(['name' => 'delete own comments']);
        Permission::create(['name' => 'delete any comments']);

        $member = Role::create(['name' => 'member']);
        $member->givePermissionTo(['create comments', 'edit own comments', 'delete own comments']);

        $author = Role::create(['name' => 'author']);
        $author->givePermissionTo(['create posts', 'edit own posts', 'delete own posts']);
        $author->givePermissionTo(['create comments', 'edit own comments', 'delete own comments']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['view unpublished posts', 'create posts', 'edit all posts', 'delete any posts']);
        $admin->givePermissionTo(['create comments', 'edit all comments', 'delete any comments']);
    }
}
