<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send($email)
    {
        $title =
            '
                You have successfully registered your account on the mps system
            ';
        $content = "content";//$request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content,$body="body"], function ($message) use ($email)
        {
            $message->subject("Set your password");

            $message->from('noreply@mps.com', 'MPS System');

            $message->to($email);

        });

        return response()->json(['message' => 'Request completed']);

    }
}
