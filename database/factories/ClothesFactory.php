<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClothesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product' => $this->faker->sentence(mt_rand(1, 4)),
            'user_id' => mt_rand(1, 4),
            'category_id' => mt_rand(1, 3),
            'slug' => $this->faker->slug(),
            'description' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")
                ->implode(''),
            'price' => mt_rand(150000, 200000),
            's' => mt_rand(1, 40),
            'm' => mt_rand(1, 40),
            'l' => mt_rand(1, 40),
            'xl' => mt_rand(1, 40),
            'xxl' => mt_rand(1, 40),
            'weight' => 1000,
        ];
    }
}
