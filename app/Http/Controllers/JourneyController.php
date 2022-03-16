<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class JourneyController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        $bufferJourneys = [];

        foreach ($user->journeys as $journey) {
            $bufferJourneys [] = $journey->serialize();
        }

        return response()->json($bufferJourneys, Response::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'origin_address' => 'required|string',
            'destination_address' => 'required|string',
        ]);

        $user = Auth::user();

        $journey = Journey::init(
            $request->get('name'),
            $request->get('origin_address'),
            $request->get('destination_address'),
            $user,
            $request->get('time'),
        );

        return response()->json($journey->serialize(), Response::HTTP_CREATED);
    }

    public function enable(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $user = Auth::user();

        $journeySelected = null;

        foreach ($user->journeys as $journey) {
            if ($journey->key === $request->get('key')) {
                $journeySelected = $journey;
            }
        }

        if (!$journeySelected) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $journeySelected->enable();
        $journeySelected->save();

        return response()->json($journeySelected->serialize(), Response::HTTP_OK);
    }

    public function disable(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $user = Auth::user();

        $journeySelected = null;

        foreach ($user->journeys as $journey) {
            if ($journey->key === $request->get('key')) {
                $journeySelected = $journey;
            }
        }

        if (!$journeySelected) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $journeySelected->disable();
        $journeySelected->save();

        return response()->json($journeySelected->serialize(), Response::HTTP_OK);
    }

    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $user = Auth::user();

        $journeySelected = null;

        foreach ($user->journeys as $journey) {
            if ($journey->key === $request->get('key')) {
                $journeySelected = $journey;
            }
        }

        if (!$journeySelected) {
            return response()->json('not found', Response::HTTP_NOT_FOUND);
        }

        $journeySelected->remove();
        $journeySelected->save();

        return response()->json('done', Response::HTTP_OK);
    }
}
