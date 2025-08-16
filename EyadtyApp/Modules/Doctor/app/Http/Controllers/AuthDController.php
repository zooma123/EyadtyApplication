<?php

namespace Modules\Doctor\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServices;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Modules\Doctor\Services\AuthDoctorService;

class AuthDController extends Controller
{
    protected  $authServiceDoctor;
    protected $authservice;

    public function __construct(AuthDoctorService $authServiceDoctor , AuthServices $authservice)
    {
        $this->authServiceDoctor = $authServiceDoctor;
    
    $this->authservice = $authservice;
    }

    public function register(RegisterRequest $request)
    {
        $doctor = $this->authServiceDoctor->registerDoctor($request->validated());
        return response()->json(['success' => true, 'doctor' => $doctor]);
    }

public function login(Request $request){

    
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



