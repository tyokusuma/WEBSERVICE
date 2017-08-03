<?php

namespace App\Http\Controllers\Transaction;

use App\Category;
use App\Graphic;
use App\Http\Controllers\ApiController;
use App\MainService;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use App\Service;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @resource Transaction
 */
class TransactionController extends ApiController
{
    public function __construct() {
        Parent::__construct();
        $this->admin = User::where('admin', User::ADMIN_USER)->get();
        // $this->middleware('client.credentials')->only(['index', 'show', 'update', 'destroy']);
    }

    public function generateTransactionCode($cat, $sub, $name) {
        $lastTransaction = DB::table('transactions')->get()->last();
        if ( ! $lastTransaction ) {
            $number = 0;
        } else  {
            $number = substr($lastTransaction->order_code, 9);  
        }
        //Category
        $cat = strtoupper(substr($cat, 0, 3));
        // Subcategory
        $subFull = str_replace('.', '', $sub);
        $subNoSpace = str_replace(' ', '', $subFull);
        $sub = strtoupper(substr($subNoSpace, 0, 3));
        //Name
        $nameFull = str_replace('.', '', $name);
        $nameNoSpace = str_replace(' ', '', $nameFull);
        $name = strtoupper(substr($nameNoSpace, 0, 3));
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
        $user = Auth::user()->id;
        if ($user != $request->buyer_id) {
            return $this->errorResponse('Your user id doesn\'t match with the access token', 409);
        }

        if ($request->has('main_service_id')) {
            $findMainService = MainService::has('service')->get()->find($request->main_service_id);
            if ($findMainService == null) {
                return $this->errorResponse('Sorry, your main service doesn\'t exist, please change it', 409);
            }
        }

        if ($request->has('buyer_id')) {
            $mainservices = MainService::has('service')->get()->pluck('id');
            $buyers = User::all()->whereNotIn('id', $mainservices)->find($request->buyer_id);
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
            'status_order' => 'required|in:'.Transaction::TRANSACTION_STATUS_1.','.Transaction::TRANSACTION_STATUS_2.','.Transaction::TRANSACTION_STATUS_3.','.Transaction::TRANSACTION_STATUS_4.','.Transaction::TRANSACTION_STATUS_5.','.Transaction::TRANSACTION_STATUS_6.','.Transaction::TRANSACTION_STATUS_7.','.Transaction::TRANSACTION_STATUS_8,
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
        $transactionCode = $this->generateTransactionCode($category->category_type, $category->subcategory_type, $name);
        $data['order_code'] = $transactionCode;
        $transaction = Transaction::create($data);

        // Create notification for service about new order
        $service = User::findOrFail($request->main_service_id);
        $msgService = 'You have a new order, please confirm it';
        $service->notify(new UserNotification($msgService));

        // Create notification for buyer about new order
        $buyer = User::findOrFail($request->buyer_id);
        $msgBuyer = 'Your order is waiting confirmation from service';
        $buyer->notify(new UserNotification($msgBuyer));
        
        // Create notification for admin
        $msgAdmin = 'New transaction created with code '.$data['order_code'];
        foreach($this->admin as $admin) {
            $admin->notify(new AdminNotification($msgAdmin));
        }

        // Find and create data for graphics
        dd($transaction->created_at->toDateString());
        $findGraphic = Graphic::where('user_id', $user)->where('date', $transaction->created_at);
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
    public function update(Request $request, $id) //only can update status_order
    {   
        $transaction = Transaction::findOrFail($id);

        if ($request->has('main_service_id')||$request->has('buyer_id')||$request->has('current_destination')||$request->has('final_destination')||$request->has('distance')||$request->has('traveling_time')) {
            return $this->errorResponse('Sorry, you can\'t edit these field, please check the allowed request update', 409);
        }

        $rules = [
            'booking' => 'required|in:'.Transaction::BOOKING.','.Transaction::NOT_BOOKING,
            'order_date' => 'required|date_format:"Y-m-d"',
            'order_time' => 'required|date_format:"H:i:s"',
            'status_order' => 'required|in:'.Transaction::TRANSACTION_STATUS_1.','.Transaction::TRANSACTION_STATUS_2.','.Transaction::TRANSACTION_STATUS_3.','.Transaction::TRANSACTION_STATUS_4.','.Transaction::TRANSACTION_STATUS_5.','.Transaction::TRANSACTION_STATUS_6.','.Transaction::TRANSACTION_STATUS_7.','.Transaction::TRANSACTION_STATUS_8,
            'satisfaction_level' => 'in:'.Transaction::SATISFACTION_LEVEL_1.','.Transaction::SATISFACTION_LEVEL_2.','.Transaction::SATISFACTION_LEVEL_3.','.Transaction::SATISFACTION_LEVEL_4.','.Transaction::SATISFACTION_LEVEL_5,
        ]; 

        $transaction->status_order = $request->has('status_order') ? $request->status_order : $transaction->status_order;
        if($transaction->status_order == Transaction::TRANSACTION_STATUS_6) {
            //ubah driver jadi unavailable
            $service = Service::where('main_service_id', $transaction->main_service_id)->with('category')->first();
            if(strtolower($service->category->type) == 'kendaraan') {
                $service['available'] = '0';
                $service->save();
            }
        }
        $transaction->booking = $request->has('booking') ? $request->booking : $transaction->booking;
        $transaction->order_date = $request->has('order_date') ? $request->order_date : $transaction->order_date;
        $transaction->order_time = $request->has('order_time') ? $request->order_time : $transaction->order_time;
        $transaction->satisfaction_level = $request->has('satisfaction_level') ? $request->satisfaction_level : $transaction->satisfaction_level;
        $transaction->comment = $request->has('comment') ? $request->comment : $transaction->comment;

        $transaction->latitude_current = $request->has('latitude_current') ? $request->latitude_current : $transaction->latitude_current;
        $transaction->longitude_current = $request->has('longitude_current') ? $request->longitude_current : $transaction->longitude_current;
        $transaction->latitude_destination = $request->has('latitude_destination') ? $request->latitude_destination : $transaction->latitude_destination;
        $transaction->longitude_destination = $request->has('longitude_destination') ? $request->longitude_destination : $transaction->longitude_destination;

        $transaction->save();

        // Create notification for service about new order
        $service = User::findOrFail($request->main_service_id);
        $msgService = 'You have a new order, please confirm it';
        $service->notify(new UserNotification($msgService));

        // Create notification for buyer about new order
        $buyer = User::findOrFail($request->buyer_id);
        $msgBuyer = 'Your order is waiting confirmation from service';
        $buyer->notify(new UserNotification($msgBuyer));
        
        // Create notification for admin
        $msgAdmin = 'New transaction created with code '.$data['order_code'];
        foreach($this->admin as $admin) {
            $admin->notify(new AdminNotification($msgAdmin));
        }   

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

    public function getByIdBookingBuyers() {
        $buyerid = Auth::user()->id;
        $transactions = Transaction::where('buyer_id', $buyerid)->where('booking', '1')->with('mainservices')->with('buyers')->paginate(10);
        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdNonBookingBuyers() {
        $buyerid = Auth::user()->id;
        $transactions = Transaction::where('buyer_id', $buyerid)->where('booking', '0')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdBookingServices() {
        $service = Auth::user()->id;
        $transactions = Transaction::where('main_service_id', $service)->where('booking', '1')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdNonBookingServices() {
        $service = Auth::user()->id;
        $transactions = Transaction::where('main_service_id', $service)->where('booking', '0')->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdBuyers() {
        $id = Auth::user()->id;
        $transactions = Transaction::where('buyer_id', $id)->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdServices() {
        $id = Auth::user()->id;
        $transactions = Transaction::where('main_service_id', $id)->with('mainservices')->with('buyers')->paginate(10);

        return response()->json([
            'data' => $transactions,
        ]);
    }

    public function getByIdandDateForService() {
        $today = Carbon::now()->toDateString();
        $user = Auth::user()->id;
        $transactions = Transaction::where('main_service_id', $user)->where('order_date', $today)->paginate(10);
        return response()->json([
                'data' => $transactions,
            ], 200);
    }
}
