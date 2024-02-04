<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Response;

class WebApiRequest extends FormRequest
{
//todo:
    protected $fieldNames = [];

    public function validationData()
    {
        if (method_exists($this, 'sanitize')) {
            $input = $this->container->call([$this, 'sanitize']);
        } else {
            $input = $this->all();
        }

        $this->replace($input);

        return $this->all();
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false, 
            'errors' => $validator->errors(), 
            'message' => ''
        ], 400));
    }

    
}