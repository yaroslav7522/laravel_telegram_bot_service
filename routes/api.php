<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Bot\TelegramBot;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/telegram_point', function (Request $request, TelegramBot $bot) {
    $bot->handle($request->all());

    return response()->json(['ok' => true]);
});
Route::get('/tasks', [TaskController::class, 'index']);