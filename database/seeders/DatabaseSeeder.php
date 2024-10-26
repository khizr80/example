<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call individual seeders
        $this->call([
            UsersSeeder::class,

            CategoriesSeeder::class,
            SubcategoriesSeeder::class,
            BlogsSeeder::class,
        ]);
    }
}
