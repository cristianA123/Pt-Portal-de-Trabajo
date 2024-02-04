<?php
namespace App\Modules\Candidates\Requests;

use App\Http\Requests\WebApiRequest;

class CreateJobRequest extends WebApiRequest
{
    public function authorize() {

        return true;
    }
   
    public function rules(){
        return [
        ];
    }


}