<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Big;

class BigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Big::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lat' => random_int(1000, 9999),
        ];
    }
}
