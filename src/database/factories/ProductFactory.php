<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(),
            'short_desc' => $this->faker->text(50),
            'description' => $this->faker->text(),
            'thumbnail_url' => $this->faker->imageUrl(),
            'gallery_url' => $this->faker->imageUrl(),
            'count' => 25 ,
            'price' => $this->faker->randomNumber(),
            'user_id' => User::factory()->create()->id,
            'cat_id' => Category::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id
        ];
    }
}
