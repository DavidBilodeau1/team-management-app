<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrokerRequest;
use App\Models\Broker;
use App\Models\Team;

class BrokerController extends Controller
{
    public function index(Team $team): \Illuminate\Http\JsonResponse
    {
        return response()->json($team->brokers);
    }

    public function show(Broker $broker): \Illuminate\Http\JsonResponse
    {
        return response()->json($broker->load('team'));
    }

    public function store(StoreBrokerRequest $request, Team $team): \Illuminate\Http\RedirectResponse
    {
        $team->brokers()->create($request->validated());

        return redirect()->route('teams.show', $team);
    }
}
