<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_name' => $this->faker->firstName(),
            'sport_name' => $this->faker->lastName(),
            'city' => $this->faker->city(),
            'email' => $this->faker->unique()->safeEmail(),
            'logo' => "public/profils_photos/d9iLyrjdEi31WPL6mBzKPLJtVIJh6fLYZMVer58L.png",
            'cover' => "public/teams_photos/IPhHmyyQ06SSNgsGvEbCq9NcufYA5cO4RxDB2YnQ.jpg"

        ];
    }
}
