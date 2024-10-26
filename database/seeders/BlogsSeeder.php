<?php
namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 blogs
        Blog::factory()->count(50)->create();
    }
}
