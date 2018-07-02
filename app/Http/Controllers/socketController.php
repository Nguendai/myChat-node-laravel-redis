<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use LRedis;

class socketController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('socket');
    }

    public function writemessage()
    {
        return view('writemessage');
    }

    public function sendMessage(){
        $redis = LRedis::connection();
        $redis->publish('message', Request::input('message'));
        return redirect('writemessage');
    }
}
