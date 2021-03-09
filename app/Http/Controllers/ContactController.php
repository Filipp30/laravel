<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller{



    public function sendMail(Request $request_data){
        $validated = $request_data->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'subject' => 'required|string|max:50',
            'user_message' => 'required|string|max:500',
        ]);

        if ($validated){
            $subject = $validated['subject'];
            try {
                Mail::send('./mails/mail',$validated,function($message) use ($subject) {
                    $message->to('filipp-tts@outlook.com','to web developer');
                    $message->subject($subject);
                    $message->cc('filipp-tts@outlook.com');
                });
                return true;
            }catch (\Exception $error){
                return $error;
            }
        }else{
            return new \Error('Given data is incorrect');
        }
    }
}
