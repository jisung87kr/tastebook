<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory(10)->create();

        $jisung = User::factory()
            ->has(Post::factory(10)
                ->state(new Sequence(
                    fn ($sequence) => [
                        'category_id' => $categories->random(),
                    ]
                ))
                ->has(Comment::factory(10)
                    ->state(new Sequence(
                        fn ($sequence) => [
                            'user_id' => User::all()->random()
                        ]
                    ))
                )
            )
            ->create([
                'name' => 'jisung',
                'email' => 'jisung87kr@gmail.com',
            ]);

        $user = User::factory(10)
            ->has(Post::factory(10)
                ->state(new Sequence(
                    fn ($sequence) => [
                        'category_id' => $categories->random(),
                    ]
                ))
                ->has(Comment::factory(10)
                    ->state(new Sequence(
                        fn ($sequence) => [
                            'user_id' => User::all()->random()
                        ]
                    ))
                )
            )
            ->create();

        $user[] = $jisung;

        foreach (Comment::all() as $index => $comment) {
            Comment::factory(10)
                ->create([
                    'user_id' => $user->pluck('id')->random(),
                    'commentable_id' => $comment->commentable->id,
                    'commentable_type' => Post::class,
                    'parent_id' =>  $comment->commentable->comments->pluck('id')->random()
                ]);
        }
    }
}
