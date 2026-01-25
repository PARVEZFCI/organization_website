<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Education' => 'All about educational topics and learning resources',
            'Technology' => 'Latest technology trends and innovations',
            'Training' => 'Professional training and skill development',
            'Study Abroad' => 'Information about studying in foreign countries',
            'Career Development' => 'Tips and strategies for career growth',
        ];

        foreach ($categories as $name => $description) {
            BlogCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'status' => true,
            ]);
        }
    }
}
