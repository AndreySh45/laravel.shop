<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Events\MessageSend;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->input('message', '');
        if (strlen($message)) {
            event(new MessageSend($message));
        }
    }
}
