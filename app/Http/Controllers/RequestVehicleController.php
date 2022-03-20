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

        $origin = $request->get('origin_address') ? $request->get('origin_address') : $user->origin_address;
        $destination = $request->get('destination_address') ? $request->get('destination_address') : $user->destination_address;

        $allTripUsers = User::byOriginDestination($origin, $destination)->get();


        $vehicles = [];

        if (count($allTripUsers) > 0) {
            $res = $this->matchService->searchVehicles($allTripUsers);

            if ($res) {
                foreach ($res[MatchService::VEHICLE_ID] as $idVechile) {
                    $vehicles [] = Vehicle::find($idVechile)->serialize(true);
                }
            }
        }


        return response()->json($vehicles, Response::HTTP_OK);
    }
}
