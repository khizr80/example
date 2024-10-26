<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // Generate 10 categories
        Category::factory()->count(10)->create();
    }
}
