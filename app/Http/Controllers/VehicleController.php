<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Engine;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        $bufferVehicles = [];

        foreach ($user->vehicles as $vehicle) {
            $bufferVehicles [] = $vehicle->serialize();
        }

        return response()->json($bufferVehicles, Response::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'brandKey' => 'required|string',
            'engineKey' => 'required|string',
            'model' => 'required|string',
            'seats' => 'required|numeric',
            'fuel_consumption' => 'required|numeric',
        ]);

        $brand = Brands::byKey($request->get('brandKey'))->first();

        if (!$brand) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $engine = Engine::byKey($request->get('engineKey'))->first();

        if (!$engine) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $user = Auth::user();

        $vehicle = Vehicle::init(
            $brand,
            $request->get('model'),
            $request->get('seats'),
            $request->get('fuel_consumption'),
            $engine,
            $user
        );

        return response()->json($vehicle->serialize(), Response::HTTP_CREATED);
    }

    public function enable(Request $request): JsonResponse
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

        $vehicleSelected->enable();
        $vehicleSelected->save();

        return response()->json($vehicleSelected->serialize(), Response::HTTP_OK);
    }

    public function disable(Request $request): JsonResponse
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

        $vehicleSelected->disable();
        $vehicleSelected->save();

        return response()->json($vehicleSelected->serialize(), Response::HTTP_OK);
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
