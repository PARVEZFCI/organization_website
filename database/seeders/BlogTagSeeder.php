<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogTag;
use Illuminate\Support\Str;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Education',
            'Technology',
            'Study',
            'Learning',
            'Training',
            'Knowledge',
            'News',
            'Skills',
            'Development',
            'Career',
            'International',
            'Research',
        ];

        foreach ($tags as $name) {
            BlogTag::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
