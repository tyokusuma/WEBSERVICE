<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends ApiController
{
    public function index()
    {
        $messages = Message::with('users')->paginate(10);

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
        $data = $request->all();

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
    public function destroy($id)
    {
        //
    }
}
