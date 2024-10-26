<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    protected $model = Subcategory::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slugs' => $this->faker->slug,
            'CategoryID' => \App\Models\Category::factory(), // Assuming a random category is assigned
        ];
    }
}
