<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\ApiController;

class Users extends ApiController
{
    public function index(Request $request)
    {
        $users=DB::table('users')->select("id","name","email","age","gender","status","created_at","updated_at","roleId")->get();
        $data=array(
            'message'=>'List of users',
            'users'=>$users,
        );
        return $this->successResponse($data,200);
    }
}
