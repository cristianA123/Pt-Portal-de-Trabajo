<?php

namespace App\Modules\Shared\Traits;
use Illuminate\Support\Facades\Log;

trait Responses {

    public function exception($resource, $request, $exception, $message, $status = 422) {

        Log::error([
            'resource' => $resource, 
            // 'usuario' => auth()->user()->email, 
            'request' => $request, 
            'exception' => $exception
        ]);

        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }

    public function failure($message, $status = 422, $request, $errors = [] ) {
        // $errors = ["valid"=>['campo']]
        // Log::error('Acción inválida', ['usuario' => auth()->user(), 'request' => $request ]);

        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }

    public function success($message, $status = 200, $data = null) {

        return response()->json([
            'success' => true,
            'message' => $message,
            'data'=>$data,
        ], $status);
    }
}