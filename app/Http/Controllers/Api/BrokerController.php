<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrokerRequest;
use App\Models\Broker;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class BrokerController extends Controller
{
    public function index(): JsonResponse
    {
        $brokers = Broker::with('team')->get();

        return response()->json($brokers);
    }

    public function show(Broker $broker): JsonResponse
    {
        return response()->json($broker->load('team'));
    }

    public function store(StoreBrokerRequest $request, Team $team): JsonResponse
    {
        $broker = $team->brokers()->create($request->validated());

        return response()->json($broker->load('team'), 201);
    }
}

