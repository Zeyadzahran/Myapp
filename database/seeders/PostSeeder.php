<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have users and categories to associate posts with
        $users = User::all();
        $categories = Category::all();

        if ($users->count() == 0) {
            // Create some users if none exist
            $users = User::factory(5)->create();
        }

        if ($categories->count() == 0) {
            // Create some categories if none exist
            $categories = Category::factory(5)->create();
        }

        // Create posts with existing users and categories
        foreach ($users as $user) {
            Post::factory(rand(2, 5))->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
        }

        // Create some additional random posts
        Post::factory(20)->create();
    }
}
