<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function getMessages(){


    }

   public function addMessage(Request $request_data){
       $message = new Chat();
       $message->user_id = Auth::user()->getAuthIdentifier();
       $message->message = $request_data->get('input_message');
       $message->save();
   }




}
