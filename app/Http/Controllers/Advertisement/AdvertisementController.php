<?php

namespace App\Http\Controllers\Advertisement;

use App\Advertisement;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends ApiController
{
    public function __construct() {
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Assuming that the api ads only for incrementing the show_count and click_count based on choosen image by admin
        $ads = Advertisement::findOrFail($id);
        if ($ads->choosen === '1') {
            if ($request->has('showing_count')) {
                $ads['showing_count'] = $ads['showing_count'] + 1;
            }

            if ($request->has('click_count')) {
                $ads['click_count'] = $ads['click_count'] + 1;
            }        
        } else {
            return $this->showMessage('Sorry you can\'t change value of unchosen ads', 409);
        }

        $ads->save();
        return $this->showOne($ads);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advertisement::where('choosen', '1')->get();
        if ($ads == null) {
            return $this->errorResponse('You don\'t have any ads', 404);
        }
        return $this->showAll($ads);
    }
}
