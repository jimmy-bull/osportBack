<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AskGame;

class AskGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AskGame::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "who_is_asking" => "jbull635@gmail.com",
            "who_was_asked" => "Jamal@gmail.com",
            'date_of_game' => $this->faker->dateTimeBetween("2022-11-22 11:30:18", "2022-12-22 11:30:18"),
            "hours_of_game" => "19h30",
            "place_of_game" => $this->faker->city(),
            "team_of_asker" => "Real Team",
            "team_of_who_was_asked" => "Jamal Foot",
            "status" => "finish"
        ];
    }
}
