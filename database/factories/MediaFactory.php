<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Media;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
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
            'slug' => Str::slug($title, '-'),
            'media_type' => fake()->randomElement(['gallery', 'slider']),
            'description' => fake()->text($maxNbChars = 400),
            'media_img' => 'No image found',
            'status' => fake()->randomElement(['0', '1']),
        ];
    }
}
