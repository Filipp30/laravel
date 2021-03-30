<?php

namespace App\Http\Controllers;

use App\Models\ChatWaitingList;
use Illuminate\Http\Request;

class AdminChatController extends Controller
{
    public function chat_waiting_list(){
       return ChatWaitingList::with('user')->get();
    }

}
