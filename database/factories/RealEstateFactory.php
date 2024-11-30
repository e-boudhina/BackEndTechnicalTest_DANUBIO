<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RealEstate>
 */
class RealEstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['House', 'Apartment']),
            'address' => $this->faker->address,
            'size' => $this->faker->randomFloat(2, 50, 300), // Size between 50m2 and 300m2
            'size_unit' => $this->faker->randomElement(['m2', 'SQFT']),
            'bedrooms' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 100000, 600000),
            'location' => DB::raw("ST_GeomFromText('POINT({$this->faker->latitude} {$this->faker->longitude})')")
        ];
    }
}
