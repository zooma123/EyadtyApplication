<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    public function getAllRoles()
    {
        $roles =  Role::all();
 return   response()->json([
'status' => 'success',
$roles

 ]);
    }

    public function createRole($name)
    {
         Role::create(['name' => $name]);

         return response()->json([
"status" =>"success"

         ]);
    }


}
