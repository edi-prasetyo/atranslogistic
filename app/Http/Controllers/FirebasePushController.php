<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebasePushController extends Controller

{
    protected $notification;
    public function __construct()
    {
        $this->notification = Firebase::messaging();
    }

    public function send_notif()
    {

        $users = User::all();
        return view('admin.notification.send', compact('users'));
    }

    public function notification(Request $request)
    {
        // $FcmToken = auth()->user()->fcm_token;
        $FcmToken = $request->input('fcm_token');
        $title = $request->input('title');
        $body = $request->input('body');
        $message = CloudMessage::fromArray([
            'token' => $FcmToken,
            'notification' => [
                'title' => $title,
                'body' => $body
            ],
        ]);

        $this->notification->send($message);
        return $message;
    }
}
