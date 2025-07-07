<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class; // ✅ یہ line add کریں

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->name;

        return [
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'designation' => fake()->jobTitle(),
            'dob' => fake()->date('Y-m-d'),
            'country' => fake()->country,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'description' => fake()->paragraph,
            'author_feature' => fake()->word,
            'facebook_id' => fake()->userName,
            'twitter_id' => fake()->userName,
            'youtube_id' => fake()->userName,
            'pinterest_id' => fake()->userName,
            'author_img' => 'no found image',
            'status' => fake()->randomElement(['0', '1']),
        ];
    }
}
