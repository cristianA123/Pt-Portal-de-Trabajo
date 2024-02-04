<?php
namespace App\Modules\Candidates\Requests;

use App\Http\Requests\WebApiRequest;

class CreateCandidateRequest extends WebApiRequest
{
    public function authorize() {

        return true;
    }
   
    public function rules(){
        return [

            'email'=>'required|email|unique:users',
        ];
    }


}