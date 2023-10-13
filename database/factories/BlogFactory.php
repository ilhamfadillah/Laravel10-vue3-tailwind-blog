<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paragraphs = '<p>' . fake()->paragraphs(1, true) . '</p>';
        for ($i = 0; $i < 10; $i++) {
            $paragraphs .= '<p>' . fake()->paragraphs(1, true) . '</p>';
            $paragraphs .= '<p>' . fake()->paragraphs(1, true) . '</p>';
        }
        return [
            'title' => fake()->words(3, true),
            'content' => $paragraphs,
            'status' => "published",
            'published_date' => now(),
        ];
    }
}
