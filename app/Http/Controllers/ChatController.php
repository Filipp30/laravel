<?php

namespace App\Http\Controllers;
use App\Events\CallAdmin;
use App\Events\NewMessage;
use App\Events\RemoveChatSession;
use App\Models\Chat;
use App\Models\ChatWaitingList;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        try {
            return Chat::with('user')
                ->where('session','=',$session)
                ->orderBy('created_at','asc')
                ->get();
        }catch (Exception $Exception){
            return $Exception;
        }
    }

    public function addMessage(Request $request_data){
        $user = Auth::user();
        $chat_session = $request_data->get('chat_session');
        $user_name = $user->name;
        $user_message = $request_data->get('input_message');
        $time_stamp = gmdate("Y-m-d H:i:s");
        try {
            event(new NewMessage($chat_session,$user_name,$user_message,$time_stamp));

            $chat = new Chat();
            $chat->user_id = $user->getAuthIdentifier();
            $chat->session = $chat_session;
            $chat->message = $user_message;
            $chat->created_at = $time_stamp;
            $chat->save();
        }catch (Exception|BroadcastException $Exception){
            return $Exception;
        }

    }

    public function call_admin_for_chat(){
        $user = Auth::user();
        $session = time();
        $name = $user->name;
        $email = $user->email;
        $created_at = $user->created_at;

        //first update database before call Event !!! from Vue call api for update local WaitList
        try {
            $call = new ChatWaitingList();
            $call->user_id = $user->getAuthIdentifier();
            $call->session = $session;
            $call->save();
            event(new CallAdmin($session));
        }catch (Exception|BroadcastException $Exception){
            return $Exception;
        }
    }

    public function remove_chat_session(Request $request_data){
        $session = $request_data->get('chat_session');
        try {
            event(new RemoveChatSession($session));
            ChatWaitingList::query()->where('session','=',$session)->delete();
            Chat::query()->where('session','=',$session)->delete();
        }catch (Exception|BroadcastException $Exception){
            return $Exception;
        }
    }
}
