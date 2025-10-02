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
            [
                'name' => 'Technology',
                'description' => 'Latest technology trends, programming, and software development'
            ],
            [
                'name' => 'Health & Fitness',
                'description' => 'Health tips, fitness routines, and wellness advice'
            ],
            [
                'name' => 'Travel',
                'description' => 'Travel guides, destinations, and adventure stories'
            ],
            [
                'name' => 'Food & Cooking',
                'description' => 'Recipes, cooking tips, and food reviews'
            ],
            [
                'name' => 'Business',
                'description' => 'Business news, entrepreneurship, and career advice'
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports news, updates, and analysis'
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Movies, music, games, and entertainment news'
            ],
            [
                'name' => 'Education',
                'description' => 'Learning resources, tutorials, and educational content'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create additional random categories using factory
        Category::factory(2)->create();
    }
}
