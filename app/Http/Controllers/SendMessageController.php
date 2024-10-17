<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SendMessageController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('admin.messages.create', compact('users'));
    }
}
