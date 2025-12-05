<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    public function index(): JsonResponse
    {
        $teams = Team::with('brokers')->get();

        return response()->json($teams);
    }

    public function show(Team $team): JsonResponse
    {
        return response()->json($team->load('brokers'));
    }

    public function destroy(Team $team): JsonResponse
    {
        $team->brokers()->delete();
        $team->delete();

        return response()->json(['message' => 'team_deleted'], 200);
    }
}

