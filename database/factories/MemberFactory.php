<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->address(),
            'email' => $this->faker->safeEmail(),
            'PIN' => Str::random(8),
            'role' => 'EE'
        ];
    }
}
