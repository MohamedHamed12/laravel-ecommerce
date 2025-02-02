<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Generate access and refresh tokens for a user.
     *
     * @param User $user
     * @return array
     */
    private function generateTokens(User $user)
    {
        // Generate access token
        $access_token = JWTAuth::fromUser($user);
        
        // Generate refresh token with different claims
        $refresh_token = JWTAuth::customClaims([
            'refresh_token' => true,
            'exp' => now()->addDays(7)->timestamp // 7 days expiry
        ])->fromUser($user);

        return [
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'token_type' => 'bearer',
            'access_token_expires_in' => config('jwt.ttl') * 60, // convert minutes to seconds
            'refresh_token_expires_in' => 7 * 24 * 60 * 60, // 7 days in seconds
        ];
    }

    /**
     * Register a new user.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $this->generateTokens($user);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'authorization' => $token
        ], 201);
    }

    /**
     * Login an existing user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $user = User::where('email', $request->email)->first();
            $tokens = $this->generateTokens($user);

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user,
                'authorization' => $tokens
            ]);

        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Could not create token.',
            ], 500);
        }
    }

    /**
     * Refresh the access token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        try {
            $refresh_token = $request->header('Authorization');
            
            if (!$refresh_token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Refresh token not provided'
                ], 401);
            }

            $refresh_token = str_replace('Bearer ', '', $refresh_token);
            
            // Validate the refresh token
            JWTAuth::setToken($refresh_token);
            $payload = JWTAuth::getPayload();
            
            if (!$payload->get('refresh_token')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid refresh token'
                ], 401);
            }

            $user = JWTAuth::authenticate();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }

            // Generate new tokens
            $tokens = $this->generateTokens($user);

            return response()->json([
                'status' => true,
                'message' => 'Token refreshed successfully',
                'authorization' => $tokens
            ]);

        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Could not refresh token',
                'error' => $e->getMessage()
            ], 401);
        }
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            
            return response()->json([
                'status' => true,
                'message' => 'Successfully logged out'
            ]);
            
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Could not logout user'
            ], 500);
        }
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'user' => $user
            ]);
            
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Not authenticated'
            ], 401);
        }
    }
}