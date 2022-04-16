<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'memberID' => $this->faker->numberBetween(1,Member::all()->count()),
            'bookID' => $this->faker->numberBetween(1,Book::all()->count()),
            'deadline' => $this->faker->date(),
            'returned' => $this->faker->boolean(),
        ];
    }
}
