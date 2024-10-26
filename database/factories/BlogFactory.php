<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'SubCategoryId' => \App\Models\Subcategory::factory(), // Link to subcategory
            'title' => $this->faker->sentence,
            'slugs' => $this->faker->slug,
            'content' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(), // Generate a random image URL
            'UserId' => \App\Models\User::factory(), // Link to a user
        ];
    }
}
