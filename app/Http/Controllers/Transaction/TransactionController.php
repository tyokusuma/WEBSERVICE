<?php

namespace App\Http\Controllers\Transaction;

use App\Category;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Notifications\UserNotification;
use App\Service;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @resource Transaction
 */
class TransactionController extends ApiController
{
    public function __construct() {
        Parent::__construct();
        
        // $this->middleware('client.credentials')->only(['index', 'show', 'update', 'destroy']);
    }

    public function generateTransactionCode($cat, $sub, $name) {
        $lastTransaction = DB::table('transactions')->get()->last();
        if ( ! $lastTransaction ) {
            $number = 0;
        } else  {
            $number = substr($lastTransaction->order_code, 9);  
        }
        $cat = strtoupper(substr($cat, 0, 3));
        $sub = strtoupper(substr($sub, 0, 3));
        $name = strtoupper(substr($name, 0, 3));
        return $cat.$sub.$name.sprintf('%09d', intval($number) + 1);    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('mainservices')->with('buyers')->paginate(10);
        // var_dump($transactions);
        return response()->json([
            'data' => $transactions,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('main_service_id')) {
            $findMainService = MainService::has('service')->get()->find($request->main_service_id);
            // dd($findMainService);
            if ($findMainService == null) {
                return $this->errorResponse('Sorry, your main service doesn\'t exist, please change it', 409);
            }
        }

        if ($request->has('buyer_id')) {
            $mainservices = MainService::has('service')->get()->pluck('id');
            $buyers = User::all()->whereNotIn('id', $mainservices)->find($request->buyer_id);
            // dd($buyers);
            if ($buyers == null) {
                return $this->errorResponse('Sorry, your buyer doesn\'t exist, please change it', 409);
            }
        }

        $rules = [
            'main_service_id' => 'required|numeric',
            'buyer_id' => 'required|numeric',
            'booking' => 'required|in:'.Transaction::BOOKING.','.Transaction::NOT_BOOKING,
            'order_date' => 'required|date_format:"Y-m-d"',
            'order_time' => 'required|date_format:"H:i:s"',
            'status_order' => 'required|in:'.Transaction::TRANSACTION_STATUS_1.','.Transaction::TRANSACTION_STATUS_2.','.Transaction::TRANSACTION_STATUS_3.','.Transaction::TRANSACTION_STATUS_4.','.Transaction::TRANSACTION_STATUS_5.','.Transaction::TRANSACTION_STATUS_6.','.Transaction::TRANSACTION_STATUS_7,
            // 'satisfaction_level' => 'in:'.Transaction::SATISFACTION_LEVEL_1.','.Transaction::SATISFACTION_LEVEL_2.','.Transaction::SATISFACTION_LEVEL_3.','.Transaction::SATISFACTION_LEVEL_4.','.Transaction::SATISFACTION_LEVEL_5.','.Transaction::SATISFACTION_LEVEL_6,
            'current_destination' => 'required',
            'final_destination' => 'required',
            'latitude_current' => 'required',
            'longitude_current' => 'required',
            'latitude_destination' => 'required',
            'longitude_destination' => 'required',
            'distance' => 'required',
            'traveling_time' => 'required|integer',
        ]; 

        $this->validate($request, $rules);

        $data = $request->all();

        $msid = $data['main_service_id'];
        $name = User::findOrFail($msid)->full_name;
        $cat = DB::table('services')->where('main_service_id', $msid)->get()->first();
        $category = Category::findOrFail($cat->category_id);
        // dd($category);
        $transactionCode = $this->generateTransactionCode($category->category_type, $category->subcategory_type, $name);
        // dd($transactionCode);
        // $data = array_add($data, ['order_code' => $transactionCode]);
        $data['order_code'] = $transactionCode;
        $transaction = Transaction::create($data);
        auth()->user()->notify(new UserNotification);
        
        return $this->showOne($transaction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return $this->showOne($transaction);
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
        $transaction = Transaction::findOrFail($id);

        if ($request->has('name_service')) {
            $service = User::findOrFail($request->main_service_id);            
            if ($service->full_name != $request->name_service) {
                return $this->errorResponse('Sorry, your name service doesn\'t match with our data', 409);
            }
        }

        if ($request->has('buyer_id')) {
            $buyer = User::findOrFail($request->buyer_id);
        }

        $rules = [
            'booking' => 'nullable|in:'.Transaction::BOOKING.','.Transaction::NOT_BOOKING,
            'order_date' => 'nullable|date_format:"Y-m-d"',
            'order_time' => 'nullable|date_format:"H:i:s"',
            'status_order' => 'nullable|in:'.Transaction::TRANSACTION_STATUS_1.','.Transaction::TRANSACTION_STATUS_2.','.Transaction::TRANSACTION_STATUS_3.','.Transaction::TRANSACTION_STATUS_4.','.Transaction::TRANSACTION_STATUS_5.','.Transaction::TRANSACTION_STATUS_6.','.Transaction::TRANSACTION_STATUS_7,
            'satisfaction_level' => 'nullable|in:'.Transaction::SATISFACTION_LEVEL_1.','.Transaction::SATISFACTION_LEVEL_2.','.Transaction::SATISFACTION_LEVEL_3.','.Transaction::SATISFACTION_LEVEL_4.','.Transaction::SATISFACTION_LEVEL_5,
        ]; 

        $transaction->main_service_id = $request->has('main_service_id') ? $request->main_service_id : $transaction->main_service_id;
        $transaction->buyer_id = $request->has('buyer_id') ? $request->buyer_id : $transaction->buyer_id;
        $transaction->order_code = $request->has('order_code') ? $request->order_code : $transaction->order_code;
        $transaction->booking = $request->has('booking') ? $request->booking : $transaction->booking;
        $transaction->order_date = $request->has('order_date') ? $request->order_date : $transaction->order_date;
        $transaction->order_time = $request->has('order_time') ? $request->order_time : $transaction->order_time;
        $transaction->status_order = $request->has('status_order') ? $request->status_order : $transaction->status_order;
        $transaction->satisfaction_level = $request->has('satisfaction_level') ? $request->satisfaction_level : $transaction->satisfaction_level;
        $transaction->comment = $request->has('comment') ? $request->comment : $transaction->comment;

        $transaction->current_destination = $request->has('current_destination') ? $request->current_destination : $transaction->current_destination;
        $transaction->final_destination = $request->has('final_destination') ? $request->final_destination : $transaction->final_destination;
        $transaction->latitude_current = $request->has('latitude_current') ? $request->latitude_current : $transaction->latitude_current;
        $transaction->longitude_current = $request->has('longitude_current') ? $request->longitude_current : $transaction->longitude_current;
        $transaction->latitude_destination = $request->has('latitude_destination') ? $request->latitude_destination : $transaction->latitude_destination;
        $transaction->longitude_destination = $request->has('longitude_destination') ? $request->longitude_destination : $transaction->longitude_destination;
        $transaction->distance = $request->has('distance') ? $request->distance : $transaction->distance;
        $transaction->traveling_time = $request->has('traveling_time') ? $request->traveling_time : $transaction->traveling_time;

        $transaction->save();   

        return $this->showOne($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return $this->showOne($transaction);
    }

    public function getByIdBookingBuyers($buyerid) {
        $transactions = Transaction::where('buyer_id', $buyerid)->where('booking', '1')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdNonBookingBuyers($buyerid) {
        $transactions = Transaction::where('buyer_id', $buyerid)->where('booking', '0')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdBookingServices($service) {
        $transactions = Transaction::where('main_service_id', $service)->where('booking', '1')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdNonBookingServices($service) {
        $transactions = Transaction::where('main_service_id', $service)->where('booking', '0')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdBuyers($id) {
        $transactions = Transaction::where('buyer_id', $id)->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdServices($id) {
        $transactions = Transaction::where('main_service_id', $id)->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }
}
