<?php
namespace App\Modules\Candidates\Requests;

use App\Http\Requests\WebApiRequest;

class CandidatesRequest extends WebApiRequest
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