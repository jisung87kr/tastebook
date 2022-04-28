<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = User::factory()->create([
            'name' => 'member',
            'email' => 'member@member.com'
        ]);

        $author = User::factory()->create([
            'name' => 'author',
            'email' => 'author@author.com'
        ]);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com'
        ]);

        $member->assignRole('member');
        $admin->assignRole('admin');
        $author->assignRole('author');

        $users = User::factory(10)->create();
        $roles = Role::all()->pluck('name')->toArray();
        foreach ($users as $index => $user) {
            $user->assignRole(array_rand($roles));
        }
    }
}
