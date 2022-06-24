<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
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
        return [
            'title' => $this->faker->sentence(mt_rand(3,6)),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->randomNumber(6,true),
            'stock' => $this->faker->randomNumber(3,true),
            'weight' => $this->faker->randomNumber(2,true),
            'detail' => collect($this->faker->paragraphs(mt_rand(5,10)))
            ->map(fn($p) => "<p>$p</p>")
            ->implode(''),
            'product_category_id' => mt_rand(1,2)
        ];
    }
}
