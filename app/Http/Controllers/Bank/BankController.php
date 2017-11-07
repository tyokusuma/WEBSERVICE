<?php

namespace App\Http\Controllers\Bank;

use App\Bank;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::orderBy('id', 'desc')->get();
        if($banks->first() == null) {
            return $this->errorMessage('Sorry we can\'t find any bank account, please retry in a few more minutes', 404);
        }
        return $this->showAll($banks);
    }
}
