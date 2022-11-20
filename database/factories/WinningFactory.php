<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Winning;

class WinningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Winning::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_id' => 106,
            'score' => rand(4, 9),
            'score_2' => rand(0, 3),
            'winner_mail' => "jbull635@gmail.com",
            'winner_team' => "Real Team",
            "status" => "accepted"
        ];
    }
}
