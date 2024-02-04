<?php
namespace App\Modules\Authentication\Requests;

use App\Http\Requests\WebApiRequest;

class TokenByIdAuthenticationRequest extends WebApiRequest
{
    public function authorize() {
       
        // $userId = auth()->user()->isAdmi;
        // $userestado = auth()->user()->state;
        
        // if($userId!=1 || $userestado==0 ){
        //     return false;
        // }
        
        return true;
    }
   
    public function rules(){
        return [
            'user_id' => 'required',
           
        ];
    }


}