<?php
namespace App\Modules\Authentication\Requests;

use App\Http\Requests\WebApiRequest;
use App\Models\Role;
use App\Models\User;

class RegisterAuthenticationRequest extends WebApiRequest
{
    public function authorize() {

        // $userId = auth()->user()->id;

        // $user = User::find(1);
     
      
        // foreach ($user->roles as $role) {
        //     // return $role->name;
        // //     echo $menu->url;
        //     if( 1 == $role->pivot->role_id){
        //         return false;
        //     }
        //     return $role->pivot->role_id;
        // //     echo $menu->pivot->status;
        // }

        

        // $userestado = auth()->user()->state;
        
        // if($userestado==0 ){
        //     return false;
        // }
        
        return true;
    }
   
    public function rules(){
        return [
            'name'=>'required',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|max:100|unique:users',
            'role_id' => 'required',
           
        ];
    }


}