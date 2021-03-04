<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;

class ContactController extends Controller{



    public function sendMail(Request $data){
        $data->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

    }



}
