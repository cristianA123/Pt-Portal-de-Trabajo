<?php
namespace App\Modules\Authentication\Requests;

use App\Http\Requests\WebApiRequest;
use App\Models\User;

class LoginAuthenticationRequest extends WebApiRequest
{
    public function authorize() {

        //?LEYENDA :
        //? 1-Administrador
        //? 2-cliente
        //? 3-vendedor
       
       
        // $userId = auth()->user()->isAdmi;
        // $userestado = auth()->user()->state;
        
        // if($userId!=1 || $userestado==0 ){
        //     return false;
        // }

           
        return true;
    }
   
    public function rules(){
        return [
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|max:100',
           
        ];
    }


}