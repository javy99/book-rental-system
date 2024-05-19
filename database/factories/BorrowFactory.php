<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reader_id' => User::factory(),
            'book_id' => Book::factory(),
            'status' => $this->faker->randomElement(['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED']),
            'request_processed_at' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'request_managed_by' => User::factory(),
            'deadline' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'returned_at' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'return_managed_by' => User::factory(),
        ];
    }
}
