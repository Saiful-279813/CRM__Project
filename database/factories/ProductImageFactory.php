<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductImage;

class ProductImageFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @var string
    */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'product_id' => $this->faker->numberBetween(1,15),
          'photo_name' => 'uploads/product/'. 'product-'.$this->faker->numberBetween(1,14).'.jpg',
        ];
    }
}
