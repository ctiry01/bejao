<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $request->validate([
            'origin_address' => 'nullable|string',
            'destination_address' => 'nullable|string',
        ]);

        $user = Auth::user();

        $allTripUsers = User::byOriginDestination($user->origin_address, $user->destination_address)->get();


        $res = $this->matchService->searchVehicles($allTripUsers);

        $vehicles = [];
        foreach ($res['id'] as $idVechile) {
            $vehicles [] = Vehicle::find($idVechile)->serialize();
        }

        return response()->json($vehicles, Response::HTTP_OK);
    }
}
