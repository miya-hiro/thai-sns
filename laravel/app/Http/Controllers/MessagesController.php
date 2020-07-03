<?php

namespace App\Http\Controllers;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $message = new Message;
        $message->msg = $request->msg;
        $message->bord_id = $request->bord_id;
        $message->user_id = $request->user_id;
        $message->save();

        $res = array(
            'message' => $message,
            'user_icon' => $message->user->icon,
            'user_name' => $message->user->name
        );

        return $res;
    }
}
