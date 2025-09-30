<?php

namespace Database\Factories;

use App\Models\Post;
use Database\Factories\Concerns\CanCreateImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    use CanCreateImages;

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->unique()->sentence(4),
            'slug' => Str::slug($title, language: app()->getLocale()),
            'content' => fake()->realText(),
            'image' => $this->createImage(),
            'published_at' => fake()->dateTimeBetween('-6 month', '+1 month'),
            'created_at' => fake()->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => fake()->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
