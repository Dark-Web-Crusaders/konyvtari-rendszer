<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title' => $this->faker->text($maxNbChars = 200),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'published' => $this->faker->date($format = 'Y', $max = 'now'),
            'quantity' => $this->faker->randomDigit(),
            'isbn' => $this->faker->numberBetween($min = 1000000000, $max = 9000000000),
            'isbn13' => $this->faker->numberBetween($min = 1000000000000, $max = 9000000000000),
            'image' => 'images/1648046590-test_asfdladsfdss.jpg',
        ];
    }
}
