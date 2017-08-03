<?php

namespace App\Http\Controllers\MessageDetail;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Message;
use App\MessageDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageDetailController extends ApiController
{
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
        $users = User::where('admin', '1')->get();
        $data = $request->all();
        $data['read_admin'] = '0';
        $data['read_user'] = '0';
        $data['sender_id'] = Auth::user()->id;

        foreach($users as $user) {
            $data['receiver_id'] = $user->id;
            $message = MessageDetail::create($data);
        }

        return $this->showMessage('Success send your messages to admin', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = MessageDetail::where('message_id', $id)->get();

        return response()->json([
                'data' => $messages,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBuyerMessageDetailById($id)
    {
        $messages = MessageDetail::where('message_id', $id)->get();
        return $this->showAll($messages);
    }

    public function getServiceMessageDetailById($id)
    {
        $messages = MessageDetail::where('message_id', $id)->get();
        return $this->showAll($messages);
    }
}
