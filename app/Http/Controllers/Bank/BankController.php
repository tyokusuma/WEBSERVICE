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
        $banks = Bank::orderBy('id', 'desc')->all();
        return $this->showAll($banks);
    }
}
