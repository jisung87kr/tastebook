<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'user_id' => User::factory(),
//            'category_id' => Category::factory(),
            'subject' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'slug' => $this->faker->slug(),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
