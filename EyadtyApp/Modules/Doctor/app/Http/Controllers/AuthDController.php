<?php

namespace Modules\Doctor\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Modules\Doctor\Services\AuthDoctorService;

class AuthDController extends Controller
{
    protected  $authService;

    public function __construct(AuthDoctorService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $doctor = $this->authService->registerDoctor($request->validated());
        return response()->json(['success' => true, 'doctor' => $doctor]);
    }
}

