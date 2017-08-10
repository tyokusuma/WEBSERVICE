<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Message;
use App\MessageDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends ApiController
{
    public function index()
    {
        $id = Auth::user()->id;
        $messages = Message::where('user_id', $id)->where('deleted_by_user', null)->with('users')->with('messageDetail')->paginate(10);

        // return response()->json(['data' => $messages, 'total' => $messages->count()], 200);
        return $this->showAllNew($messages);
    }  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        if($id != $request->user_id) {
            return $this->errorResponse('Your user id doesn\'t match with the access token', 409);
        }
        $data = $request->all();
        $data['read_admin'] = '0';
        $data['read_user'] = '0';
        $message = Message::create($data);

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
        $messages = Message::where('user_id', $id)->with('users')->get();

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

        return $this->showMessage('The message successfully deleted', 200);
    }

    public function getBuyerMessageById() //$id user
    {
        $user = Auth::user()->id;
        $messages = Message::where('user_id', $user)->get();
        return $this->showAll($messages);
    }

    public function getServiceMessageById() //$id user
    {
        $user = Auth::user()->id;
        $messages = Message::where('user_id', $user)->get();
        return $this->showAll($messages);
    }
}
