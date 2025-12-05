<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function index(): Response
    {
        $teams = Team::withCount('brokers')->get();

        return Inertia::render('Teams/Index', [
            'teams' => $teams,
        ]);
    }

    public function show(Team $team): Response
    {
        $team->load('brokers');

        return Inertia::render('Teams/Show', [
            'team' => $team,
        ]);
    }

    public function destroy(Team $team): \Illuminate\Http\RedirectResponse
    {
        $team->brokers()->delete();
        $team->delete();

        return redirect()->route('teams.index');
    }
}
