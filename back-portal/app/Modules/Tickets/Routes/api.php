<?php

use App\Modules\Tickets\Controllers\TicketController;
use Illuminate\Support\Facades\Route;


  // Route::group(['middleware' => ['web-api','CheckStatusUser']], function () {
    // Route::post('/logout', [AuthenticationController::class, 'logout']);
    // Route::get('/me', [AuthenticationController::class, 'me']);
    // Route::post('/tokenById', [AuthenticationController::class, 'tokenById']);
  // });

  Route::get('/tickets', [TicketController::class, 'getTickets']);
  Route::post('/ticket', [TicketController::class, 'createTicket']);

  // Route::group(['middleware' => ['web-api','CheckStatusUser']], function () {
    // Route::post('/createAgenda', [AgendasController::class, 'createAgenda']);
    // Route::post('/updateAgenda', [AgendasController::class, 'updateAgenda']);
    // Route::post('/deleteAgenda', [AgendasController::class, 'deleteAgenda']);
  
    // Route::get('/getContacts', [AgendasController::class, 'getContacts']);
    // Route::post('/createContact', [AgendasController::class, 'createContact']);
    // Route::post('/updateContact', [AgendasController::class, 'updateContact']);
    // Route::post('/deleteContact', [AgendasController::class, 'deleteContact']);
    // Route::get('/getExampleContacts', [AgendasController::class, 'getExampleContacts']);
  // });