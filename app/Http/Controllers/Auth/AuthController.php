<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register a new user
    public function register(RegisterRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        $appName = env('APP_NAME', 'FLy');

        $token = $user->createToken($appName);

        return response([
            'message' => 'User registered successfully.',
            'data' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }

    // Login a user
    public function login(LoginRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $appName = env('APP_NAME', 'Fly');
        $token = $user->createToken($appName);

        return response([
            'message' => 'Login successful.',
            'data' => $user,
            'token' => $token->plainTextToken,
        ], 200);
    }

    // Logout a user
    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'message' => 'User logged out successfully.',
        ]);
    }
}
