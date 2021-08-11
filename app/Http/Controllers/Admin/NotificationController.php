<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{//$notification->read
    public function index(){
        $user=Auth::user();
        $notifications= $user->notifications;
        foreach($notifications as $notification){
     $notification->read();}
       return view('admin.notification',[
         'notifications'=>$notifications
       ]);
    }
}
