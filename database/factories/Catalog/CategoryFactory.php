<?php

namespace database\factories\Catalog;

use App\Models\Catalog\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title =  fake()->realText(20);
        $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($title)));
        return [
            'status' => 1,
            'title' => fake()->realText(20),
            'description' => fake()->realText(400),
            'banner' => null,
            'anchor' => 0,
            'display_type' => 0,
            'slug' => $slug,
            'meta_title' => $title,
            'meta_description' => fake()->realText(170),
            'meta_image' => null,
            'parent_id' => 0,
            'sort_order' => null
        ];
    }
}
