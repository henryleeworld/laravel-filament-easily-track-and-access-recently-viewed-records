<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Author::factory(1)
            ->has(
                Post::factory()->count(5)
                    ->state(fn (array $attributes, Author $author) => ['category_id' => Category::inRandomOrder()->first()->id]),
                'posts'
            )
            ->create();
    }
}
