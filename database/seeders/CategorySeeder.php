<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Electronics', 'category_description' => 'Devices and gadgets'],
            ['category_name' => 'Beauty', 'category_description' => 'Various types of beauty products'],
            ['category_name' => 'Clothing', 'category_description' => 'Men and Women clothing'],
            ['category_name' => 'Home Appliances', 'category_description' => 'Household appliances'],
            ['category_name' => 'Sports', 'category_description' => 'Sports and fitness equipment']
        ];

        // Insert the categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
