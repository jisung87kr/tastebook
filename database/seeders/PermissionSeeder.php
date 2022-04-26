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

        $author = Role::create(['name' => 'author']);
        $admin = Role::create(['name' => 'admin']);

        $author->givePermissionTo(['create posts', 'edit own posts', 'delete own posts']);
        $admin->givePermissionTo(['view unpublished posts', 'create posts', 'edit all posts', 'delete any posts']);

        $user1 = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com'
        ]);

        $user2 = User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@test.com'
        ]);

        $user1->assignRole('admin');
        $user2->assignRole('author');
    }
}
