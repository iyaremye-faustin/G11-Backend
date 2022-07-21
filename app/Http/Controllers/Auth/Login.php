<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class Login extends ApiController
{
    /**
     * @OA\Post(
     * path="/api/user/login",
     * operationId="Login",
     * tags={"User"},
     * summary="User Login",
     * description="User Login to WeForYouth Application",
     *     @OA\RequestBody(
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"email","password"},
     *                  @OA\Property(property="email", type="text"),
        *               @OA\Property(property="password", type="text"),
     *               ),
     *          ),
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="Successfully Logged In",
     *        @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid data in the request",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=411,
     *         description="Invalid email or password",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal error",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function index(Request $login)
    {
        try {
            $rules=[
                'email'=>"required|exists:users|email",
                'password'=>"required|min:8|string",
            ];
            $validate=Validator::make($login->all(),$rules);
            if($validate->fails()){
                $errors=$validate->errors();
                return $this->errorResponse("Invalid data in the request",422,$errors);
            }

            $user=User::where('email',$login->email)->first();
            if($user){
                if(Hash::check($login->password,$user->password)){
                    $token= $user->createToken(config('app.SECRET_KEY'))->plainTextToken;
                    $data=array(
                        'message'=>'Successfully Logged In',
                        'user'=>array(
                            'name'=>$user->name,
                            'email'=>$user->email,
                        ),
                        'accessToken'=>$token,
                        'status'=>200
                    );
                    return $this->successResponse($data,200);
                }
                return $this->errorResponse("Invalid Email or Password",411,'');
            }
            return $this->errorResponse("User Not Found or Invalid",411,'');
        } catch (\Throwable $th) {
            return $this->errorResponse("Internal server error",500,'');
        }
    }
}
