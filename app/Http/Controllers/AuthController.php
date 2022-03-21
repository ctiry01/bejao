<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user->serialize(),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'origin_address' => 'required|string',
            'destination_address' => 'required|string',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'seats' => 'nullable|numeric',
            'fuel_consumption' => 'nullable|numeric',
        ]);

        $user = User::init(
            $request->get('name'),
            $request->get('email'),
            $request->get('password'),
            $request->get('origin_address'),
            $request->get('destination_address'),
        );

        if ($request->get('brand') &&
            $request->get('model') &&
            $request->get('seats') &&
            $request->get('fuel_consumption')) {
            Vehicle::init(
                $request->get('brand'),
                $request->get('model'),
                $request->get('seats'),
                $request->get('fuel_consumption'),
                $user
            );
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user->serialize(),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }


}
