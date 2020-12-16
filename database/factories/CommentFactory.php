<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // General post id and random body.
            'body' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
            'post_id'=>\App\Models\Post::inRandomOrder()->first()->id,
            'user_id'=>\App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
