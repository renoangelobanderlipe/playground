<?php

use App\Http\Controllers\DataExchangeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(DataExchangeController::class)->prefix('prospect')->group(function () {

  Route::post('upload', 'upload');
  Route::get('export', 'export');
  Route::get('test', 'test');
  Route::get('status', 'status');
});
