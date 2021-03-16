<?php

namespace App\Http\Controllers;

use App\Events\ChatMessager;
use App\Http\Middleware\Authenticate;
use App\Models\Chat;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function getMessages(){
        $chat = new Chat();
        $chat = DB::select('SELECT users.name,chats.created_at AS time,chats.message
         FROM chats INNER JOIN users ON chats.user_id = users.id');
        return $chat;

//      Model->user :hasMany and Model->Chat:belongsTo =
//        $user_id = auth()->user()->id;
//        $user = User::find($user_id);
//        return $user->chat_messages;
    }

   public function addMessage(Request $request_data){

//       $message = new Chat();
////       $message->user_id = Auth::user()->getAuthIdentifier();
//       $message->user_id = auth()->user()->id;
//       $message->message = $request_data->get('input_message');
//       $message->save();
//       $message = $request_data->get('input_message');

//       broadcast(new ChatMessager('hello'))->toOthers();
//       return 'hello from controller';
       event(new ChatMessager('Hey from Event'));

   }




}
