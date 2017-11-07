<?php

namespace App\Http\Controllers\MessageDetail;

use App\Events\AdminNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCM\FCMController;
use App\Message;
use App\MessageDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageDetailWebController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'content' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $msg = Message::findOrFail($request->message_id);
        if($msg->deleted_by_user != null) {
            $msg['deleted_by_user'] = null;
            $msg->save();
        }

        $data = $request->all();
        if($request->hasFile('image')) {
            $data['image'] = $request->image->store('');
        }

        $data['admin_id'] = null;
        $data['read_admin'] = MessageDetail::READ_MESSAGEDETAILS;
        $data['read_user'] = MessageDetail::UNREAD_MESSAGEDETAILS;

        $messageDetail = MessageDetail::create($data);

        //create notification for other admin
        $msgAdmin = "Admin replied to message with title ".$msg->title;
        event(new AdminNotificationEvent($msgAdmin));

        //notifikasi user
        $msgUser = 'New reply from admin at your message title "'.$msg['title'].'"';
        $user = User::findOrFail($request->user_id);
        $notifUser = new FCMController();
        // $notifUser->sendAndroidNotification($user, ucwords(MessageDetail::TITLE_MSG_DETAIL), $msgUser, MessageDetail::TAG_MSG_DETAIL);

        return redirect()->back();

    }

    public function getDetail($id_message, $user_id, $full_name) {
        $read = Message::findOrFail($id_message);
        $read['read_admin'] = Message::READ_MESSAGE;
        $read->save();

        $messages = MessageDetail::where('message_id', $id_message)->orderBy('id', 'desc')->get();
        $pp = User::where('id', $user_id)->first()->profile_image;
        return view('layouts.web.messagedetail.index')->with('messages', $messages)->with('id', $id_message)->with('user_id', $user_id)->with('full_name', $full_name)->with('profile_image', $pp);

    }
}
