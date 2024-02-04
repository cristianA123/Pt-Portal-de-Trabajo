<?php
namespace App\Modules\Authentication\Requests;

use App\Http\Requests\WebApiRequest;
use App\Models\User;

class LoginByIdAuthenticationRequest extends WebApiRequest
{
    public function authorize() {

      

           
        return true;
    }
   
    public function rules(){
        return [
           
        ];
    }


}