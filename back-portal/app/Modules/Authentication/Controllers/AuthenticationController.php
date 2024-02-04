<?php

namespace App\Modules\Authentication\Controllers;

use App\Modules\Authentication\Contracts\IAuthentication;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Modules\Authentication\Requests\LoginAuthenticationRequest ;
use App\Modules\Authentication\Requests\LoginByIdAuthenticationRequest;
use App\Modules\Authentication\Requests\RegisterAuthenticationRequest;
use App\Modules\Authentication\Requests\TokenByIdAuthenticationRequest;

use App\Modules\Shared\Traits\Responses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller{
    
    use Responses ;
    protected $IAuthentication ;

    public function __construct(IAuthentication $IAuthentication){
        $this->IAuthentication = $IAuthentication;
    }

    public function login(LoginAuthenticationRequest $request){
        try {
            $credentials = request(['email', 'password']);
            $token = $this->IAuthentication->login($credentials);

            if (!$token) {

                return response()->json([
                    'success' => false,
                    'message' => 'Por favor, verifique su email o contraseña'
                ], 401);
            }
       
            return response()->json([
                'success' => true, 
                'data' => [
                    'access_token' => $token,
                    'user'=>auth()->user()
                ]
            ],200);


		} catch(Exception $ex) {
			Log::error('Error API login()', ['usuario' => auth()->user(),'params' => $request, 'stackTrace' => $ex]);

			return response()->json(['success' => false, 'message' => 'Ocurrió un error al iniciar sesión']);
		}
    }

    public function loginById($id, LoginByIdAuthenticationRequest $request){

        try {

            $user = User::where('state',true)->find($id);
            if( !$user ){
                return $this->failure("No se pudo encontrar usuario", 400, $request);
            }

               //TODO: verificar que el user tenga el rol correcto
            if(!$this->isAdminOrSuperAdmin()){
            return $this->failure("No tiene el rol permitido", 403, $request);
            }

            $token = $this->IAuthentication->loginById($user);

            $father_services = $this->IAuthentication->servicesByUserId(auth()->user()->id);

            
            return response()->json([
                'success' => true, 
                'data' => [
                    'access_token' => $token,
                    'user'=>$user
                ]
            ],200);


            
            $token = $this->IAuthentication->loginById($id);
            

        } catch (\Throwable $th) {
            return $this->exception("Error API login by id",json_encode( $request ),json_encode($th ), "No se pude iniciar sesión , Hable con el administrador", 422);

        }


    }


    public function register(RegisterAuthenticationRequest $request){

        $result = $this->IAuthentication->register($request);
        return $result;
      
    }

    public function me(){
        
        $user = $this->IAuthentication->me();

		return response()->json(
			[
				'success' => true, 
				'user' => $user
			], 200
		);
	} 

    public function logout(){

        try {
			auth()->logout();
			return response()->json([
                'success' => true, 
                'message' => 'Cerró sesión con éxito'
            ]);
		} catch (Exception $ex) {
			Log::error('Error API logout()', ['usuario' => 'usuario1', 'stackTrace' => $ex]);
			return response()->json([
                'success' => false, 
                'message' => 'Ocurrió un error al cerrar sesión'
            ]);
		}

    }

    public function refresh(Request $request){

        try {
            $token = $this->IAuthentication->refresh();
			return response()->json(
				[
					'success' => true, 
					'data' => 
						[
							'token' => $token,
							'token_type' => 'bearer'
						]
				], 200
			);
		} catch (Exception $ex) {
			Log::error('Error API refrest()', ['params' => $request, 'stackTrace' => $ex]);
			return response()->json(
				[
					'success' => false, 
					'message' => 'Ocurrió un error al refrescar sesión'
				]);
		}
    }

    public function tokenById(TokenByIdAuthenticationRequest $data){
		
        $tokenById = $this->IAuthentication->tokenById($data);

		if (!$tokenById) {
			return response()->json(
				[
					'success' => false,
					'message' => 'Usuario o contraseña incorrecta']
			);
		} else {
			return response()->json([
				'success' => true, 
				'data' => 
					[
						'token' => $tokenById, 
						'token_type' => 'bearer', 
						'user' => auth()->user()
					]
			]);
		}
    }
}
