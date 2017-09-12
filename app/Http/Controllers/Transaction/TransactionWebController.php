<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('mainservices.service.category')->with('buyers')->paginate(10);
        // return response()->json([
        //         'data' => $transactions,
        //     ]);
        // foreach($transactions as $transaction) 
        // {
        //     $mainservices = $transaction->mainservices;
        //     $buyers = $transaction->buyers;
        //     $categories = $transaction->mainservices->service->category;
        // }

        return view('layouts.web.transaction.index')->with('transactions', $transactions);
    }
}
