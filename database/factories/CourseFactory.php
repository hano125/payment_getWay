<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'course_name'       => ucwords($name),
            'slug'              => Str::slug($name) . '-' . $this->faker->unique()->numerify('######'),
            'price'             => $this->faker->numberBetween(10, 500),
            'description'       => $this->faker->paragraph(),
            'stripe_product_id' => null,
        ];
    }
}
