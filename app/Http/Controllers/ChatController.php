<?php

namespace App\Http\Controllers;
use App\Events\CallAdmin;
use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\ChatWaitingList;
use App\Models\User;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
session_start();
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMessages(Request $request_data){
        $session=$request_data->get('chat_session');
        return Chat::with('user')
            ->where('session','=',$session)
            ->orderBy('created_at','asc')
            ->get();
    }

    public function addMessage(Request $request_data){
        $user = Auth::user();
        $chat_session = $request_data->get('chat_session');
        $user_name = $user->name;
        $user_message = $request_data->get('input_message');
        $time_stamp = gmdate("Y-m-d H:i:s");
        try {
            event(new NewMessage($chat_session,$user_name,$user_message,$time_stamp));
        }catch (BroadcastException $broadcastException){
            return $broadcastException;
        }
        $chat = new Chat();
        $chat->user_id = $user->getAuthIdentifier();
        $chat->session = $chat_session;
        $chat->message = $user_message;
        $chat->created_at = $time_stamp;
        $chat->save();
    }

    public function call_admin_for_chat(){
        $user = Auth::user();
        $session = time();
        try {
            $call = new ChatWaitingList();
            $call->user_id = $user->getAuthIdentifier();
            $call->session = $session;
            $call->save();
            event(new CallAdmin());
            return $session;
        }catch (Exception|BroadcastException $exception){
            return $exception;
        }
    }

    public function remove_chat_session(Request $request_data){
        $session = $request_data->get('chat_session');
        DB::table('chat_waiting_list')->where('session','=',$session)->delete();
        DB::table('chats')->where('session','=',$session)->delete();
        return $session;
    }
}
