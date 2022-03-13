<?php

namespace Database\Factories;

use App\Models\ThirdCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThirdCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
    */
    protected $model = ThirdCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $thirdcategoryName = $this->faker->unique()->words($nb = 4, $asText = true);
        $slug = Str::slug($thirdcategoryName);
        return [
            'category_id' => $this->faker->numberBetween(1,5),
            'subcategory_id' => $this->faker->numberBetween(1,5),
            'thirdcategory_name' => $thirdcategoryName,
            'thirdcategory_slug' => $slug,
            'user' => 1
        ];
    }
}
