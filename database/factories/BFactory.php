<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\testingTable;
class BFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\testingTable::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lat' => Str::random(10),
        ];
    }
}
