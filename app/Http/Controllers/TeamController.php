<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Teams/Index');
    }

    public function show(Team $team): Response
    {
        return Inertia::render('Teams/Show', [
            'teamId' => $team->id,
        ]);
    }
}
