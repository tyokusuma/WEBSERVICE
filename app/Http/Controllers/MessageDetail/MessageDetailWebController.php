<?php

namespace App\Http\Controllers\MessageDetail;

use App\Http\Controllers\Controller;
use App\MessageDetail;
use App\User;
use Illuminate\Http\Request;

class MessageDetailWebController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'message_id' => 'required|numeric',
            'sender_id' => 'required|numeric',
            'receiver_id' => 'required|numeric',
            'content' => 'required|string',
            'read_admin' => 'required|in:'.MessageDetail::UNREAD_MESSAGEDETAILS,
            'read_user'=> 'required|in:'.MessageDetail::UNREAD_MESSAGEDETAILS,
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $messageDetail = MessageDetail::create($data);
        $notifs = request()->get('notifs');
        // return redirect()->route('view-inbox-details', ['id', $request->message_id]);
        return redirect()->back()->with('notifs', $notifs);

    }

    public function getDetail($id, $user_id, $full_name) {
        $messages = MessageDetail::where('message_id', $id)->get();
        $pp = User::where('id', $user_id)->first()->profile_image;
        $notifs = request()->get('notifs');
        return view('layouts.web.messagedetail.index')->with('messages', $messages)->with('id', $id)->with('user_id', $user_id)->with('full_name', $full_name)->with('notifs', $notifs)->with('profile_image', $pp);

    }
}
