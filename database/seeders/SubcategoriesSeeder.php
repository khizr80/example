<?php
namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesSeeder extends Seeder
{
    public function run()
    {
        // Generate 30 subcategories
        Subcategory::factory()->count(30)->create();
    }
}
