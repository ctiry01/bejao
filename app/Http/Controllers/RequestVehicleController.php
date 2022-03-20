<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Service\MatchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        /*$request->validate([
            'seats' => 'required|numeric',
            'origin_address' => 'nullable|string',
            'destination_address' => 'nullable|string',
        ]);*/

        //$user = Auth::user();

        //$vehicles = Vehicle::isActive()->bySeats($request->get('seats'))->others($user)->get();

        $this->matchService->searchVehicles();

        return response()->json("done", Response::HTTP_OK);
    }
}
