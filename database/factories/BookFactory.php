<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
        return [
            'title' => $this->faker->sentence(3, true),
            'authors' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'released_at' => $this->faker->date(),
            'cover_image' => $this->faker->imageUrl(),
            'pages' => $this->faker->numberBetween(50, 1000),
            'language_code' => $this->faker->languageCode(),
            'isbn' => $this->faker->isbn13(),
            'in_stock' => $this->faker->numberBetween(0, 100),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            // Check if genres exist; if not, create them
            if (Genre::count() == 0) {
                Genre::factory()->count(5)->create();  // Create 5 genres if none exist
            }

            // Attach 1-3 random genres to the book
            $genres = Genre::inRandomOrder()->limit(rand(1, 3))->get();
            $book->genres()->attach($genres);
        });
    }
}
