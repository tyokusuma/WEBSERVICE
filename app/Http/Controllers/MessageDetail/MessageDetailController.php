<?php

namespace App\Http\Controllers\MessageDetail;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\MessageDetail;
use Illuminate\Http\Request;

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
        $data = $request->all();

        $message = MessageDetail::create($data);

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
}
