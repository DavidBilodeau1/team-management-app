<?php

namespace Database\Seeders;

use App\Models\Broker;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $teams = Team::factory(5)->create();

        $teams->each(function (Team $team) {
            Broker::factory(rand(2, 5))->create([
                'team_id' => $team->id,
            ]);
        });
    }
}
