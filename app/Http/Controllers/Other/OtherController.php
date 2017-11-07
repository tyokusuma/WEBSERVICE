<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\ApiController;
use App\MainService;
use App\Other;
use App\Service;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherController extends ApiController
{
    public static function setting() {
        $setting = Other::orderBy('id', 'desc')->all()->first();

        return $setting;        
    }
    
    public function termsApp()
    {
        //
    }
}
