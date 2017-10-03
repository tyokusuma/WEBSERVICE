<?php

namespace App\Http\Controllers\MessageDetail;

use App\Events\AdminNotificationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Message;
use App\MessageDetail;
use App\Notifications\AdminNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageDetailController extends ApiController
{
    public function __construct() {
        $this->admin = User::where('admin', [User::ADMIN_USER, User::SUPERADMIN_USER])->get();
    }

    public function index() {
        $messages = MessageDetail::all();

        return response()->json([
                'data' => $messages,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = Message::findOrFail($request->message_id);
        if($msg->deleted_by_user == '1') {
            return $this->onlyMessage('Sorry your message doesn\'t exist');
        }

        if($msg->deleted_by_admin != null) {
            $msg['deleted_by_admin'] = null;
            $msg->save();
        }


        $data = $request->all();
        if($request->hasFile('image')) {
            $data['image'] = $request->image->store('');
        }
        $data['read_admin'] = '0';
        $data['read_user'] = '1';
        $data['user_id'] = null;
        $data['admin_id'] = 0;

        //create notification for admin 
        $msgAdmin = 'New reply from user for message "'.$msg->title.'"';
        event(new AdminNotificationEvent($msgAdmin));
        // foreach($this->admin as $admin) {
        //     $admin->notify(new AdminNotification($msgAdmin));
        // }

        $msgDetail = MessageDetail::create($data);
        return $this->showMessage('Success send your messages to admin', 201);
    }

    public function getMessageDetailById($id) //fetch all message detail, $id->message bukan user
    {
        $messages = MessageDetail::where('message_id', $id)->with('message.users')->get();
        return $this->showAll($messages);
    }
}
