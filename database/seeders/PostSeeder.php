<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Attachment;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(10)->create();
        $categories = Category::factory(10)->create();
        $users = User::all();
        Post::factory(10)
            ->state(new Sequence(
                fn ($sequence) => [
                    'category_id' => $categories->random(),
                    'user_id' => $users->random(),
                ]
            ))
            ->hasAttached($tags)
            ->has(
                Attachment::factory(3)
            )
            ->create();
    }
}
