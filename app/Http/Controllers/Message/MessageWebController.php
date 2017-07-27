<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Message;
use App\MessageDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('users')->paginate(10);
        foreach($messages as $message) {
            $count = MessageDetail::where('message_id', $message->id)->where('sender_id', $message->user_id)->where('read_admin', '0')->count();
            $message['count'] = $count;
        }
        $notifs = request()->get('notifs');
        return view('layouts.web.message.index')->with('messages', $messages)->with('count', $count)->with('notifs', $notifs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = request()->get('notifs');
        $users = User::all()->sortBy('full_name');
        return view('layouts.web.message.create')->with('users', $users)->with('notifs', $notifs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->all();
        $data['read_admin'] = '1';
        $data['read_user'] = '0';
        $validator = Validator::make($data, [
            'user_id' => 'required|numeric',
            'title' => 'required|string',
            'read_admin' => 'required|in:'.Message::READ_MESSAGE,
            'read_user' => 'required|in:'.Message::UNREAD_MESSAGE,        
        ]); 

        if ($validator->fails()) {
            if ($data->has('user_id')) {
                flash('Sorry the receiver name is doesn\'t exist')->error()->important();
            }

            if ($data->has('title')) {
                flash('Sorry the title need to be string')->error()->important();
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Message::create($data);

        $find = Message::all()->last();
        $user = User::where('id', $find->user_id)->first();
        $notifs = request()->get('notifs');
        return redirect()->route('view-inbox-details', ['id' => $find->id, 'user_id' => $find->user_id, 'full_name' => $user->full_name])->with('notifs', $notifs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $details = MessageDetail::where('message_id', $id)->get();
        foreach ($details as $detail) {
            $detail->read_admin = '1';
            $detail->save();
        }

        $message = Message::where('id', $id)->first();
        $message->read_admin = '1';
        $message->save();

        $user = User::where('id', $message->user_id)->first();
        $notifs = request()->get('notifs');
        return redirect()->route('view-inbox-details', ['id' => $id, 'user_id' => $user->id, 'full_name' => $user->full_name, 'notifs' => $notifs]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $details = MessageDetail::where('message_id', $id)->get();
        foreach($details as $detail) {
            $detail->delete();            
        }
        $message = Message::findOrFail($id);
        $message->delete();
        $notifs = request()->get('notifs');
        return redirect()->route('view-inbox')->with('notifs', $notifs);
    }
}
