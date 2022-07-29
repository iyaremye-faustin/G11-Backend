<?php

namespace App\Http\Controllers\Roles;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiController;

class UserRole extends ApiController
{
    public function index(Request $request)
    {
        $userId=$request->user;
        if(!$userId){
            return $this->errorResponse("Invalid data in the request",422,'');
        }
        $user=User::find($userId);
        if(!$user){
            $errors=array('message'=>'User is invalid or not found');
            return $this->errorResponse("Invalid data in the request",404,$errors);
        }
        $role=Role::where('id',$user->roleId)->first('roleName');
        return $this->successResponse($role,200);
    }
    public function assignRole(Request $data)
    {
        $rules=[
            'rolename'=>"required|exists:roles,roleName",
            'user'=>"required|integer|exists:users,id",
        ];
        $validate=Validator::make($data->all(),$rules);
        if($validate->fails()){
            $errors=$validate->errors();
            return $this->errorResponse("Invalid data in the request",422,$errors);
        }
        $role=Role::where('roleName',$data->rolename)->first();
        if(!$role){
            $errors=array('message'=>'Role name is invalid or not found');
            return $this->errorResponse("Invalid data in the request",404,$errors);
        }
        $userId=Auth::user()->id;
        $userRole=Auth::user()->roleId;
        if($userId==$data->user || $userRole!=1){
            return $this->errorResponse("Can't perform this operation",401,'');
        }
        $user = User::find($data->user);
        $user->roleId=$role->id;
        $user->save();
        return $this->successResponse(['message'=>"User status updated"],200);
    }
}
