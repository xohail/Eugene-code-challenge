<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinics>
 */
class ClinicsFactory extends Factory
{
    public static $australianStateAbbreviations = [
    'NSW',
    'VIC',
    'QLD',
    'WA',
    'SA',
    'TAS',
    'NT',
    'ACT',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'house' => fake()->buildingNumber(),
            'street' => fake()->streetAddress(),
            'suburb' => fake()->city(),
            'postcode' => fake()->postcode(),
            'state' => fake()->randomElement(self::$australianStateAbbreviations), // password
            'geocode' => fake()->latitude().','.fake()->longitude(),
        ];
    }
}
