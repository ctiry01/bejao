<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Service\MatchService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class RequestVehicleController extends Controller
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'seats' => 'required|numeric',
            'origin_address' => 'nullable|string',
            'destination_address' => 'nullable|string',
        ]);

        $vehicles = Vehicle::isActive()->bySeats($request->get('seats'))->get();

        $res = $this->matchService->searchVehicles($vehicles, $request->get('origin_address'), $request->get('destination_address'));

        return response()->json($res, Response::HTTP_OK);
    }


}
