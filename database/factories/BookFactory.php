<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
           'category_id' => 1,
            'author_id' => 1,
            'title' => $title,
            'slug' => Str::slug($title . '-'),
            'availability' => fake()->randomElement(['In Stock', 'Out of Stock']),
            'price' => fake()->randomFloat(2, 5, 100),
            'rating' => fake()->numberBetween(1, 5),
            'publisher' => fake()->company,
            'country_of_publisher' => fake()->country,
            'isbn' => fake()->isbn13,
            'isbn_10' => fake()->isbn10,
            'audience' => fake()->randomElement(['General', 'Children', 'Teens', 'Adults']),
            'format' => fake()->randomElement(['Paperback', 'Hardcover', 'PDF', 'ePub']),
            'language' => fake()->languageCode,
            'total_pages' => fake()->numberBetween(100, 800),
            'downloaded' => fake()->numberBetween(0, 5000),
            'edition_number' => fake()->numberBetween(1, 10),
            'recommended' => fake()->randomElement(['Yes', 'No']),
            'description' => fake()->paragraph(4),
            'book_img' => 'no image found',
            'book_upload' => fake()->url,
            'status' => fake()->randomElement(['0', '1']),
        ];
    }
}
