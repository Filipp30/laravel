<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class ContactController extends Controller{



    public function sendMail(Request $data){
//        $data->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255',
//            'subject' => 'required|string|max:100',
//            'message' => 'required|string|max:1000',
//        ]);
        $data = array('name'=>$data->name,
            'email'=>$data->email,
            'subject'=>$data->subject,
            'message'=>$data->message
        );
        Mail::send('mail',$data,function($message){
            $message->to('filipp-tts@outlook.com','to web developer');
            $message->subject('test subject');
            $message->cc('filipp-tts@outlook.com');
        });

    }



}
