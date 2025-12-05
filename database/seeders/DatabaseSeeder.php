<?php

namespace Database\Seeders;

use App\Models\Broker;
use App\Models\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::factory(5)->create();

        $teams->each(function (Team $team) {
            Broker::factory(rand(2, 5))->create([
                'team_id' => $team->id,
            ]);
        });
    }
}
