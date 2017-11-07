<?php

namespace App\Http\Controllers\Message;

use App\Events\AdminNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCM\FCMController;
use App\Message;
use App\MessageDetail;
use App\Notifications\AdminNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageWebController extends Controller
{
    public function __construct() {
        $this->admin = User::where('admin', [User::ADMIN_USER, User::SUPERADMIN_USER])->get();
    }

    public function index()
    {
        $messages = Message::where('deleted_by_admin', null)->with('users')->orderBy('id', 'desc')->paginate(10);
        foreach($messages as $message) {
            $count = MessageDetail::where('message_id', $message->id)->where('admin_id', 0)->where('read_admin', '0')->count();
            $message['count'] = $count;
        }
        // return response()->json([
        //         'data' => $messages
        //     ]);
        return view('layouts.web.message.index')->with('messages', $messages);
    }

    public function create()
    {
        $users = User::where('admin', User::REGULER_USER)->get()->sortBy('full_name');
        return view('layouts.web.message.create')->with('users', $users);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required|numeric',
            'title' => 'required|string',
        ]); 

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data['read_admin'] = '1';
        $data['read_user'] = '0';
        $data['admin_id'] = 0;
        $data['admin_created'] = auth()->user()->id;
        $data['admin_updated'] = auth()->user()->id;

        $message = Message::create($data);

        //notifikasi user
        $msgUser = 'New reply from admin at your message title "'.$data['title'].'"';
        $user = User::findOrFail($request->user_id);
        $notifUser = new FCMController();
        // $notifUser->sendAndroidNotification($user, ucwords(Message::TITLE_MESSAGE), $msgUser, Message::TAG_MESSAGE);

        return redirect()->route('view-inbox-details', ['id' => $message->id, 'user_id' => $message->user_id, 'full_name' => $user->full_name]);
    }

    // public function update(Request $request, $id)
    // {
    //     $details = MessageDetail::where('message_id', $id)->get();
    //     foreach ($details as $detail) {
    //         $detail->read_admin = '1';
    //         $detail->save();
    //     }

    //     $message = Message::where('id', $id)->first();
    //     $message->read_admin = '1';
    //     $message->save();

    //     $user = User::where('id', $message->user_id)->first();
    //     return redirect()->route('view-inbox-details', ['id' => $id, 'user_id' => $user->id, 'full_name' => $user->full_name]);
    // }

    public function destroy($id)
    {
        $msg = Message::findOrFail($id);

        $msgDetails = MessageDetail::where('message_id', $id)->get();
        if($msgDetails != null) {
            foreach($msgDetails as $msgDetail) {
                $msgDetail['deleted_by_admin'] = auth()->user()->id;
                $msgDetail->save();
            }
        }
        
        $msg['deleted_by_admin'] = auth()->user()->id;
        $msg->save();

        flash('Your message successfully deleted')->success();
        return redirect()->route('view-inbox');
    }
}
