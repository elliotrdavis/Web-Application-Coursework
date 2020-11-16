<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Generate random title and description
            'title' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
        ];
    }
}
