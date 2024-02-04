<?php

namespace App\Modules\Authentication\Repositories;

use App\Models\Report;
use App\Modules\Authentication\Contracts\IAuthentication;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
// use DB;

use function PHPUnit\Framework\returnSelf;

class RepoAuthentication implements IAuthentication {

    protected $model ;
    public function __construct($model){
        $this->model = $model;
    }

    public function login($credentials){

        $token = auth()->attempt($credentials);
        return $token;
    }

    public function loginById($user){

        $token=  JWTAuth::fromUser($user);
        return $token;

    }


    public function register($data){

        try {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->password);
            // $user->role = $data->role;
            $user->save();
    
            $user->roles()->attach($data->role_id);
            
            if(isset($user)){

                return response()->json([
                    'success' => true,
                    'user' => $user
                ],201);

            }else{
                return response()->json([
                    'success' => false,
                    'message' => "No se pudo registrar usuario, hable con el admi"
                ], 404);
            }
        } catch (Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo registrar usuario, hable con el admi",
                'error'=>$th
            ], 500);
        }
        
    }

    public function me (){
        return auth()->user();
	}

    public function logout(){
    }

    public function servicesByUserId($id)
    {
        $userService =  DB::select(
            "SELECT su.service_id, s.name 
            FROM service_users su, services s, users u 
            WHERE su.service_id = s.id and su.user_id=u.id and u.id = $id"
        );

        return $userService;
    }


    public function refresh(){
		$token = auth()->refresh();
        return $token;
    }

    public function tokenById($data){
        $tokenById = auth()->tokenById($data->user_id);
        return $tokenById;
    }

}


?>