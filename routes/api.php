<?php

use App\Events\ChatMessager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});
Route::post('/contact','App\Http\Controllers\ContactController@sendMail');

Route::post('chat/add_message','App\Http\Controllers\ChatController@addMessage');

Route::get('chat/get_all_messages','App\Http\Controllers\ChatController@getMessages');

//Route::post('chat/add_message',function (){
//    broadcast(new ChatMessager(''))->toOthers();
//
//});
