<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Defeat;

class DefeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Defeat::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_id' => 106,
            'score' => rand(1, 3),
            'score_2' => rand(4, 7),
            'looser_mail' => "Jamal@gmail.com",
            'looser_team' => "Jamal Foot",
            "status" => "accepted"
        ];
    }
}  // Jamal Foot
