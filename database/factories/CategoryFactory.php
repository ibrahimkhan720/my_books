<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title=fake()->name;
        return [
            'title' => $title,
            'slug' => Str::slug($title , '-'),
            'description' => fake()->paragraph,
            'status' => fake()->randomElement(['0', '1']),
        ];
    }
}
