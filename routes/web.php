<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\TasksControllerController;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/tasks', [TasksController::class, 'index']);
