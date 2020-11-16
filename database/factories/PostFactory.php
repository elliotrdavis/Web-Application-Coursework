<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Generate user_id, page_id and random title and body.
            'title' => $this->faker->text($maxNbChars = 20),
            'body' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'user_id'=>\App\Models\User::inRandomOrder()->first()->id,
            'page_id'=>\App\Models\Page::inRandomOrder()->first()->id,
        ];
    }
}
