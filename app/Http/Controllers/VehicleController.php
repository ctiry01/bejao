<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'seats' => 'required|numeric',
            'fuel_consumption' => 'required|numeric',
        ]);

        $user = Auth::user();

        $vehicle = Vehicle::init(
            $request->get('brand'),
            $request->get('model'),
            $request->get('seats'),
            $request->get('fuel_consumption'),
            $user
        );

        return response()->json($vehicle->serialize(true), Response::HTTP_CREATED);
    }

    public function enable(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $user = Auth::user();

        if (!$user->vehicle) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $user->vehicle->enable();
        $user->vehicle->save();

        return response()->json($user->serialize(), Response::HTTP_OK);
    }

    public function disable(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $user = Auth::user();

        if (!$user->vehicle) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $user->vehicle->disable();
        $user->vehicle->save();

        return response()->json($user->serialize(), Response::HTTP_OK);
    }

    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $user = Auth::user();

        $vehicleSelected = null;

        foreach ($user->vehicles as $vehicle) {
            if ($vehicle->key === $request->get('key')) {
                $vehicleSelected = $vehicle;
            }
        }

        if (!$vehicleSelected) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $vehicleSelected->remove();
        $vehicleSelected->save();

        return response()->json('done', Response::HTTP_OK);
    }
}
