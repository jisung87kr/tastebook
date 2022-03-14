<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attachment;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Attachment::class;

    public function definition()
    {
//        return [
//            'path' => $this->faker->unique()->word(),
//            'name' => $this->faker->unique()->word(),
//            'ext' => $this->faker->unique()->word(),
//            'size' => $this->faker->unique()->word(),
//            'attachementable_id' => Post::factory()/,
//            'attachementable_type' => Post::class,
//        ];
    }
}
