<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class Logout extends ApiController
{
    public function logout(Request $logout)
    {
        $logout->user()->tokens()->delete();
        $data=array(
            'message'=>'Successfully Logged Out',
        );
        return $this->successResponse($data,200);
    }
}
