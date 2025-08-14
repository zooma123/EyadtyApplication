<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
protected  $authservice;
    public function __construct(AuthServices $authservice){

$this->authservice =$authservice;
    
}

    public Function Register(RegisterRequest $request){


$user = $this->authservice->register($request->validated());
return response()->json([
    'status' => 'success',
    'user' => $user
]);
        }


        public Function Login (Request $request){

            if ($request->filled('email') && $request->filled('password')) {
                $user = $this->authservice->loginWithEmail($request->email, $request->password);
            }
    
            // Case 2: phone login with OTP
            elseif ($request->filled('phonenumber') && $request->filled('otp')) {
                $user = $this->authservice->loginWithPhoneOtp($request->phonenumber, $request->otp);
            } else {
                return response()->json(['message' => 'Invalid login data'], 422);
            }
    
            if (!$user) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
    
            $token = $user->createToken('authToken')->plainTextToken;
    
            return response()->json([
                'message' => 'Login successful',
                'token' => $token
            ]);
        }
              
              

}
