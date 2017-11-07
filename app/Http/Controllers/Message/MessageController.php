<?php

namespace App\Http\Controllers\Message;

use App\Events\AdminNotificationEvent;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Message;
use App\MessageDetail;
use App\Notifications\AdminNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends ApiController
{
    public function __construct() {
        $this->admin = User::where('admin', [User::ADMIN_USER, User::SUPERADMIN_USER])->get();
        $this->middleware('auth:api');
    }

    // public function index()
    // {
    //     $id = Auth::user()->id;
    //     $messages = Message::where('user_id', $id)->where('deleted_by_user', null)->with('users')->with('messageDetail')->paginate(10);

    //     // return response()->json(['data' => $messages, 'total' => $messages->count()], 200);
    //     return $this->showAllNew($messages);
    // }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $data['read_admin'] = '0';
        $data['read_user'] = '1';
        $data['user_id'] = $user->id;
        $message = Message::create($data);

        //notifikasi admin
        // $msgAdmin = 'New Message created from User '.$user->full_name.' with title "'.$data['title'].'"';
        // event(new AdminNotificationEvent($msgAdmin));
        // foreach($this->admin as $admin) {
        //     $admin->notify(new AdminNotification($msgAdmin));
        // }

        return $this->showOne($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Message::where('user_id', $id)->with('users')->orderBy('id', 'desc')->get();

        return $this->showAll($messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //id message
    {
        $user = Auth::user()->id;
        $msg = Message::findOrFail($id);
        if ($msg->user_id != $user) {
            return $this->errorResponse('Sorry you don\'t have authorization to delete these message', 401);
        }

        $msgDetails = MessageDetail::where('message_id', $id)->get();
        if($msgDetails != null) {
            foreach($msgDetails as $msgDetail) {
                $msgDetail['deleted_by_user'] = Carbon::now();
                $msgDetail->save();
            }
        }
        
        $msg['deleted_by_user'] = Carbon::now();
        $msg->save();

        return $this->onlyMessage('The message successfully deleted', 200);
    }

    public function getMessageById() //$id user
    {
        $user = Auth::user()->id;
        $messages = Message::where('user_id', $user)->where('deleted_by_user', null)->orderBy('created_at', 'DESC')->get();
        return $this->showAll($messages);
    }
}
