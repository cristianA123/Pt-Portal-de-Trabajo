<?php
namespace App\Modules\Tickets\Requests;

use App\Http\Requests\WebApiRequest;

class CreateTicketRequest extends WebApiRequest
{
    public function authorize() {

        return true;
    }
   
    public function rules(){
        return [
            // 'name'=>'required|max:255',
        ];
    }


}