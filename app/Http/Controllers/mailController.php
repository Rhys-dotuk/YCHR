<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;

class mailController extends Controller
{
    public function send($id, $file_name)
    {
        $user = User::find($id)->first();
        $name = $user->name;
        $email = $user->email;

        $data = array(
            'name' => $name,
            'email' => $email,
            'file_name' => $file_name,
            );

        Mail::send('mail.send', $data, function($message) use ($data) {
            $message->to($data['email']);
            $message->subject('TEST EMAIL');
            $message->from('rhysmcclew@outlook.com');
        });

        return redirect()->route('file.download', ['file_name' => $file_name]);
    }
}
