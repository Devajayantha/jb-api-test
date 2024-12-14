<?php

/*
|--------------------------------------------------------------------------
| API Documentation Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;

if (app()->environment('local')) {
  Route::view('/doc-v1', 'documentation.api', [
    'title' => 'Juicebox Test - v1',
    'api_yml' => asset('api_documentation/v1.yml'),
  ]);

  Route::get('/doc-v1-postman', function () {
    return response()->download(base_path('postman_api_collection.json'));
  });
}
