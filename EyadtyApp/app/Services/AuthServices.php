<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
   
    protected string $role = 'owner'; 

   
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = $this->role;
        $user = User::create($data);
        $user->assignRole($data['role']);

        // If phone exists → create OTP
        if (!empty($data['phonenumber'])) {
            $otpCode = rand(100000, 999999);
            Otp::create([
                'user_id' => $user->id,
                'code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(1),
            ]);

            // Here you send SMS via your SMS service
        }

        return $user;
    }

    public function loginWithEmail(string $email, string $password)
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return null;
        }

        return Auth::user();
    }

    public function loginWithPhoneOtp(string $phone, string $otp)
    {
        $user = User::where('phonenumber', $phone)->first();
        if (!$user) return null;

        $otpRecord = Otp::where('user_id', $user->id)
            ->where('code', $otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) return null;

        $otpRecord->delete(); // OTP used
        return $user;
    }




    




}
