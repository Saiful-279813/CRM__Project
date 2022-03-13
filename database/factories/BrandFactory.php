<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
    */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brandName = $this->faker->unique()->words($nb = 8, $asText = true);
        $slug = Str::slug($brandName);
        return [
            'brand_name' => $brandName,
            'brand_slug' => $slug,
            'user' => 1
        ];
    }
}
