<?php

namespace App\Modules\Authentication\Routes;
// namespace App\Modules\Reports\Controller;

use App\Modules\Authentication\Controllers\AuthenticationController;

use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthenticationController::class,"login"]);


Route::group(['middleware' => ['jwt.verify']], function() {


    Route::post('/login/{id}', [AuthenticationController::class,"loginById"]);

    Route::get("/me",[AuthenticationController::class, "me"]);
    Route::get('/logout', [AuthenticationController::class,"logout"]);
    Route::get('/refresh', [AuthenticationController::class,"refresh"]);
    Route::post('/tokenById', [AuthenticationController::class,"tokenById"]);
    Route::post('/register', [AuthenticationController::class,"register"]);

});


?>