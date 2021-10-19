<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class AuthController extends BaseApiController
{
    public function register(Request $request){

        $isvalid = \Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'

        ]);

        if ($isvalid->fails()) {
            return $this->failedResponse($isvalid->messages()->first());
        }
        $validated = $isvalid->validated();

        $user =  User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('snipperToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->successResponse($response);
    }

    public function login(Request $request){
        $isvalid = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $isvalid['email'])->first();

        if( !$user || !Hash::check($isvalid['password'], $user->password)) {
            return $this->failedResponse('Bad Creds');
        }

        $token = $user->createToken('snipperToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->successResponse($response);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse([
            'message' => 'Logout successfully'
        ]);
    }
}
