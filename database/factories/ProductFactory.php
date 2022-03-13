<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @var string
    */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productName = $this->faker->unique()->words($nb = 12, $asText = true);
        $color = $this->faker->unique()->words($nb = 5, $asText = true);
        $tags = $this->faker->unique()->words($nb = 5, $asText = true);
        $slug = Str::slug($productName);
        return [
          // insert data in database
          'user_id' => 1,
          'brand_id' => $this->faker->numberBetween(1,5),
          'category_id' => $this->faker->numberBetween(1,5),
          'subcategory_id' => $this->faker->numberBetween(1,5),
          'thirdcategory_id' => $this->faker->numberBetween(1,5),
          'product_name' => $productName,
          'product_slug' => $slug,
          'product_code' => 'SQK'.$this->faker->numberBetween(100,500),
          'product_qty' => $this->faker->numberBetween(10,100),
          'product_tags' => $tags,
          'product_size' => $this->faker->numberBetween(10,100),
          'product_color' => $color,
          'selling_price' => $this->faker->numberBetween(200,4000),
          'discount_price' => $this->faker->numberBetween(10,200),
          'tax' => $this->faker->numberBetween(0,50),
          'short_descp' => $this->faker->text(200),
          'long_descp' => $this->faker->text(500),
          'product_thambnail' => 'uploads/product/'. 'product-'.$this->faker->numberBetween(1,14).'.jpg',
          'hot_deals' => $this->faker->numberBetween(0,1),
          'featured' => $this->faker->numberBetween(0,1),
          'special_offer' => $this->faker->numberBetween(0,1),
          'special_deals' => $this->faker->numberBetween(0,1),
          // insert data in database
        ];
    }
}
