<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class StoreProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_id'=> $this->faker->numberBetween(1, 1000),
            'name'=>$this->faker->unique()->sentence(),
            'bin'=>$this->faker->randomDigit(),
            'quantity'=>$this->faker->randomDigit(),
        ];
    }
}
