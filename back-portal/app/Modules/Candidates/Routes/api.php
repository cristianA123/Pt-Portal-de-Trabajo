<?php

use App\Modules\Candidates\Controllers\CandidatesController;
use Illuminate\Support\Facades\Route;


// Route::group(['middleware' => ['jwt.verify']], function() {
  Route::get('/candidates', [CandidatesController::class, 'getCandidates']);
  Route::post('/candidate', [CandidatesController::class, 'createCandidate']);
  Route::post('/job', [CandidatesController::class, 'createJob']);
  Route::get('/jobs', [CandidatesController::class, 'getJobs']);

  Route::post('/apply', [CandidatesController::class, 'createApply']);

  Route::post('/my-applications', [CandidatesController::class, 'myApplications']);
  Route::post('/detailJob', [CandidatesController::class, 'detailJob']);

// });

