<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Highlight;
use App\Models\User;

class HighlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Highlight::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'text' => fake()->text(),
            'location' => fake()->text(),
            'chapter' => fake()->word(),
            'color' => fake()->word(),
            'is_favorite' => fake()->boolean(),
            'clipped_at' => fake()->dateTime(),
            'book_id' => ::factory(),
            'user_id' => User::factory(),
            'deleted_at' => fake()->dateTime(),
        ];
    }
}
