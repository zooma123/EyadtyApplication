<?php

namespace Modules\Doctor\Services;

use App\Services\AuthServices;

class AuthDoctorService extends AuthServices
{
    protected string $role = 'doctor'; // This already sets the role

    public function __construct()
    {
        parent::__construct();
        // No need to set $this->role again since it's already set above
    }

    public function registerDoctor(array $data)
    {
        // Call the parent register method which will use the 'doctor' role
        return $this->register($data);
    }






}



