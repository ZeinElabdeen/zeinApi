<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function create () {
        return view('dashboard.notification.create');
    }

    public function store()
    {
//        dd(request()->all());

        $this->validate(request(),[
            'message'  => 'required|string|regex:/[اأإء-ي]/ui',
        ]);

        $users = User::all();
        $tokens = $users->pluck('fcm_token')->toArray();
        $this->send($tokens,request()->message);
        foreach ($users as $user) {
            Notification::create([
            'user_id' => $user->id,
            'message' => request()->message,
        ]);
        }
        return back()->with('success','تم إرسال الإشعارات بنجاح');
    }

}
