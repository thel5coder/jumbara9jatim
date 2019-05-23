<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Namshi\JOSE\JWT;
use Symfony\Component\VarDumper\Caster\DateCaster;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }



    public function login()
    {
        $result = $this->userService->checkLogin(Input::get('userName'),Input::get('password'));

        if($result->isSuccess()){

            return response([
                'status' => 'success',
                'token'=>$result->getResult()
            ])->header('Authorization', $result->getResult());
        }else{
            return response([
                'status'=>'error',
                'message'=>$result->getErrorMessages()
            ],400);
        }

    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function getExpiration(){
        $payload = JWTAuth::parseToken()->getPayload();
        $expirePayload = strtotime($payload->get('exp'));
        $expires_at = date('Y-m-d H:i',$payload->get('exp'));
        $dateObj = date('c',strtotime('2019-01-07'));

        try{
            $user = JWTAuth::parseToken();
            return response(['isSuccess'=>true,'expiration'=>strtotime($dateObj),'dateNow'=> $dateObj]);
        }catch (TokenExpiredException $exception){
            return response(['isSuccess'=>false,'expiration'=>$expires_at,'dateNow'=> $dateObj]);
        }

    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function changePassword(){
        $result = $this->userService->changePassword(Input::get('userName'),Input::get('password'));

        return $this->getJsonResponse($result);
    }
}
