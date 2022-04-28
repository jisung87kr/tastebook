<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = Comment::factory(100)
        ->state(new Sequence(
          fn ($sequence) => [
              'user_id' => User::all()->random(),
              'commentable_id' => Post::all()->random(),
              'commentable_type' => Post::class,
          ]
        ))
        ->create();

        foreach ($comments as $index => $comment) {
            $comment::factory(10)
                ->state(new Sequence(
                    fn ($sequence) => [
                        'user_id' => User::all()->random(),
                        'commentable_id' => $comment->commentable->id,
                        'commentable_type' => Post::class,
                        'parent_id' => $comment->commentable->comments->pluck('id')->random()
                    ]
                ))
                ->create();
        }
    }
}
