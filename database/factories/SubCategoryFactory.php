<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
    */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subcategoryName = $this->faker->unique()->words($nb = 4, $asText = true);
        $slug = Str::slug($subcategoryName);
        return [
            'category_id' => $this->faker->numberBetween(1,5),
            'subcategory_name' => $subcategoryName,
            'subcategory_slug' => $slug,
            'user' => 1
        ];
    }
}
