<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text($maxNbChars = 10),
            'desc' => $this->faker->text($maxNbChars = 30),
            'category_id' => ProductCategory::query()->inRandomOrder()->value('id'),
            'inventory_id' => ProductInventory::query()->inRandomOrder()->value('id'),
            'discount_id' => Discount::query()->inRandomOrder()->value('id'),
            'price' => $this->faker->numberBetween($min = 1000000, $max = 10000000)
        ];
    }
}
