<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Bot\TelegramBot;
//use App\Http\Controllers\Api\TasksControllerController;
//use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', function (Request $request, TelegramBot $bot) {
    $bot->handle($request->all());
    return response()->json(['ok' => true]);
});


//Route::get('/tasks', [TasksController::class, 'index']);
