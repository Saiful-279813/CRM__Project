<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
    */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryName = $this->faker->unique()->words($nb = 2, $asText = true);
        $slug = Str::slug($categoryName);
        return [
            'category_name' => $categoryName,
            'category_slug' => $slug,
            'user' => 1
        ];
    }
}
