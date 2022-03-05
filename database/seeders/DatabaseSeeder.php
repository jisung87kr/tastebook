<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'jisung',
            'email' => 'jisung87kr@gmail.com',
        ]);

        Post::factory(20)->create([
            'user_id' => $user->id
        ]);

        Post::factory(50)->create();
    }
}
