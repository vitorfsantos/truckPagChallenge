<?php

namespace App\Modules\Foods\Models;

use App\Modules\Foods\Models\Foods;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodsFactory extends Factory
{
  protected $model = Foods::class;

  public function definition()
  {
    return [
      'import_id' => \App\Modules\Foods\Models\ImportsLogs::factory(), // Associe o ImportLog
      'code' => $this->faker->unique()->word,
      'status' => $this->faker->randomElement(['active', 'inactive']),
      'url' => $this->faker->url,
      'creator' => $this->faker->name,
      'created_t' => $this->faker->dateTime,
      'last_modified_t' => $this->faker->dateTime,
      'product_name' => $this->faker->word,
      'quantity' => $this->faker->numberBetween(1, 100),
      'brands' => $this->faker->word,
      'categories' => $this->faker->word,
      'labels' => $this->faker->word,
      'cities' => $this->faker->word,
      'purchase_places' => $this->faker->word,
      'stores' => $this->faker->word,
      'ingredients_text' => $this->faker->text,
      'traces' => $this->faker->text,
      'serving_size' => $this->faker->word,
      'serving_quantity' => $this->faker->randomFloat(1, 1, 100),
      'nutriscore_score' => $this->faker->randomFloat(2, 0, 100),
      'nutriscore_grade' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E']),
      'main_category' => $this->faker->word,
      'image_url' => $this->faker->imageUrl,
      'imported_t' => $this->faker->dateTime,
    ];
  }
}
