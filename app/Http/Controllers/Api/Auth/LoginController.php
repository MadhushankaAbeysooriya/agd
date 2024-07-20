<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('mobile', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken($request->mobile);
            $token = $tokenResult->accessToken;

            $userRole = $user->roles->pluck('name','name')->toArray();

            // Sort in ascending order while maintaining key-value associations
            natsort($userRole);

            // Assuming $userRole is an associative array like before
            $userRoles = implode('_', array_values($userRole));

            return response()->json([
                'user_id' => $user->id,
                'first_name' => $user->fname,
                'last_name' => $user->lname,
                'userRole' => $userRoles,
                'api_token' => $token,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function generateToken(Request $request)
    {
        // Validate the request data
        $request->validate([
            'mobile' => 'required|exists:users,mobile',
        ]);

        // Find the user by mobile number
        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {
            $tokenResult = $user->createToken($request->mobile);
            $token = $tokenResult->accessToken;

            // Return the user details and the token
            return response()->json([
                'api_token' => $token,
            ], 200);
        } else {
            // Return an unauthorized response if the user is not found
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function logout(Request $request)
    {
        if (Auth::user()) {
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        }
    }


}
