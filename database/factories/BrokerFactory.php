<?php

namespace Database\Factories;

use App\Models\Broker;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrokerFactory extends Factory
{
    protected $model = Broker::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'team_id' => Team::factory(),
        ];
    }
}
