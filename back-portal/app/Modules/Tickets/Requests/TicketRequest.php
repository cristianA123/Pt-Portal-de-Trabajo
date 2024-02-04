<?php
namespace App\Modules\Tickets\Requests;

use App\Http\Requests\WebApiRequest;

class TicketRequest extends WebApiRequest
{
    public function authorize() {
        //todo: Validar quienes pueden listar agendas?
        return true;
    }
   
    public function rules(){
        return [
           
        ];
    }


}