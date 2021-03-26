<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('chat/add_message','App\Http\Controllers\ChatController@addMessage');

    Route::get('chat/get_all_messages','App\Http\Controllers\ChatController@getMessages');

    Route::get('chat/call_admin_for_chat','App\Http\Controllers\ChatController@call_admin_for_chat');

    Route::get('chat/remove_chat_session','App\Http\Controllers\ChatController@remove_chat_session');
});

Route::post('/contact','App\Http\Controllers\ContactController@sendMail');


