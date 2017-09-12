<?php

namespace App\Http\Controllers\Transaction;

use App\Category;
use App\Events\AdminNotificationEvent;
use App\Graphic;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FCM\FCMController;
use App\Http\Controllers\Graph\GraphController;
use App\MainService;
use App\Notifications\AdminNotification;
use App\Service;
use App\Traits\FcmTrait;
use App\Traits\GoogleMapTrait;
use App\Traits\GraphicTrait;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends ApiController
{
    use FcmTrait, GoogleMapTrait, GraphicTrait;

    public function __construct() {
        // Parent::__construct();
        $this->admin = User::where('admin', [User::SUPERADMIN_USER])->first();
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

    public function store(Request $request)
    {
        $errors = array();
        $user = Auth::user();
        $now = Carbon::now();
        $findService = MainService::where('id', $request->main_service_id)->with('service.category')->first();

        //Check transaksi buyer sesuai dengan tgl order_date trus d cari apa ada yg bentrok jamnya 
        $findTransactions = Transaction::where('order_date', '=', $request->order_date)->where('buyer_id', $user->id)->whereIn('status_order', [Transaction::TRANSACTION_STATUS_1, Transaction::TRANSACTION_STATUS_3, Transaction::TRANSACTION_STATUS_6, Transaction::TRANSACTION_STATUS_7, Transaction::TRANSACTION_STATUS_8])->with('mainservices.service.category')->get();
        foreach($findTransactions as $transaction) {
            if(strtolower($transaction->mainservices->service->category->type) == Category::CATEGORY_KENDARAAN) {
                $errors['limit'] = 'You had unfinished transaction for category type '.Category::CATEGORY_KENDARAAN;
            }

            $estimate_start = Carbon::createFromFormat('H:i:s', $transaction->order_time)->subMinutes(30);
            $estimate_end = Carbon::createFromFormat('H:i:s', $transaction->order_time)->addMinutes(20);
            $order_time = Carbon::createFromFormat('H:i:s', $transaction->order_time);
            if($order_time->between($estimate_start, $estimate_end)) {
                $errors['conflict'] = 'You already had a transaction between time '.$estimate_start->toTimeString().'-'.$estimate_end->toTimeString();
            }

            if($errors != null) {
                return $this->errorResponse($errors, 409);
            }
        }

        $order_time = Carbon::createFromFormat('H:i:s', $request->order_time);
        if($now->diffInMinutes($order_time, false) <= Transaction::TRANSACTION_MAX_RANGE) {
            $errors['max_time'] = 'Sorry your transaction time already take more than '.Transaction::TRANSACTION_MAX_RANGE.' minutes, please create a new transaction';
        }

        if($request->main_service_id == $user->id) { //buyer can't do transaction with their own sevrvice account
            $errors['unauthorize'] = 'You can\'t create transaction with service id of your own id';
        } else {
            if($findService->service == null) {
                $errors['not_found'] = 'We can\'t find this service id';
            }
        }
        
        $rules = [
            'main_service_id' => 'required|numeric',
            'booking' => 'required|in:'.Transaction::BOOKING.','.Transaction::NOT_BOOKING,
            'order_date' => 'required|date_format:"Y-m-d"',
            'order_time' => 'required|date_format:"H:i:s"',
            'current_destination' => 'required|string',
            'final_destination' => 'required|string',
            'latitude_current' => 'required|numeric', //tujuan awal, ato lokasi buyer
            'longitude_current' => 'required|numeric', //tujuan awal, ato lokasi buyer
            'longitude_destination' => 'required|numeric', //tujuan akhir, ato lokasi tujuan buyer
            'latitude_destination' => 'required|numeric', //tujuan akhir, ato lokasi tujuan buyer
        ]; 

        $this->validate($request, $rules);

        $data = $request->all();

        //generate transaction code
        $transactionCode = $this->generateTransactionCode($findService->service->category->category_type, $findService->service->category->subcategory_type, $findService->full_name);
        $data['order_code'] = $transactionCode;
        $data['status_order'] = Transaction::TRANSACTION_STATUS_1;    
        $data['buyer_id'] = $user->id;
        $data['satisfaction_level'] = null;
        $data['comment'] = null;
        $data['priority'] = null;

        $transactions = Transaction::where('main_service_id', $request->main_service_id)->where('order_date', $request->order_date)->whereNotIn('status_order', [Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_4])->get();
        $distance = $this->distanceMatrix($data['latitude_current'], $data['longitude_current'], $data['latitude_destination'], $data['longitude_destination']);
        //klo nga ketemu distance tampilin error & retry again
        retry(3, function() use ($data) {
            $distance = $this->distanceMatrix($data['latitude_current'], $data['longitude_current'], $data['latitude_destination'], $data['longitude_destination']);
        }, 350);
        //----------------------------------------------------
        $travel_time = $distance->rows[0]->elements[0]->duration->value;
        $distance_km = ceil(intval($distance->rows[0]->elements[0]->distance->value) / pow(10, 3));
        if($distance_km > Transaction::TRANSACTION_MAX_KM) {
            $errors['max_distance'] = 'Sorry our limit distance is '.Transaction::TRANSACTION_MAX_KM.' km';
        }
        
        //untuk check apa ada transaksi yg bentrok
            if(strtolower($findService->service->category->type) == Category::CATEGORY_KENDARAAN) {
                switch (strtolower($findService->service->category->category_type)) {
                    case Category::CATEGORY_SUB_OJEK:
                        $start = Carbon::createFromFormat('H:i:s', $request->order_time)->subMinutes(Transaction::TRANSACTION_MOTOR_MIN);
                        $end = Carbon::createFromFormat('H:i:s', $request->order_time)->addSeconds($travel_time)->addMinutes(Transaction::TRANSACTION_MOTOR_MAX);
                        if($transactions != null) {
                            foreach($transactions as $transaction) {
                                $start_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_start);
                                $end_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_end);
                                //check apa order_time_start / order_time_end ada diantara estimation_time_end, and estimation_time_start
                                $checkStart = $start->between($start_old, $end_old);
                                $checkEnd = $end->between($start_old, $end_old);

                                if($checkStart == true || $checkEnd == true) { //klo ada yg in between tampilin error
                                    $errors['conflict'] = 'Sorry your booking time is conflict with other transaction of these provider';
                                }
                            }
                        }

                        break;
                    default:
                        $start = Carbon::createFromFormat('H:i:s', $request->order_time)->subMinutes(Transaction::TRANSACTION_MOBIL_MIN);
                        $end = Carbon::createFromFormat('H:i:s', $request->order_time)->addSeconds($travel_time)->addMinutes(Transaction::TRANSACTION_MOBIL_MAX);
                        if($transactions != null) {
                            foreach($transactions as $transaction) {
                                $start_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_start);
                                $end_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_end);
                                //check apa order_time_start / order_time_end ada diantara estimation_time_end, and estimation_time_start
                                $checkStart = $start->between($start_old, $end_old);
                                $checkEnd = $end->between($start_old, $end_old);

                                if($checkStart == true || $checkEnd == true) { //klo ada yg in between tampilin error
                                    $errors['conflict'] = 'Sorry your booking time is conflict with other transaction of these provider';
                                }
                            }
                        }
                        break;
                }
                $data['distance'] = $distance->rows[0]->elements[0]->distance->text;
                $data['traveling_time'] = $distance->rows[0]->elements[0]->duration->text;
                $data['estimation_time_start'] = $start;
                $data['estimation_time_end'] = $end;

            } else {
                if($findService->service->location_abang != Service::STAYED_SHOP) { //abang yg berpindah perlu d tracking juga
                    $start = Carbon::createFromFormat('H:i:s', $request->order_time)->subMinutes(Transaction::TRANSACTION_PEDAGANG_MIN);
                    $end = Carbon::createFromFormat('H:i:s', $request->order_time)->addSeconds($travel_time)->addMinutes(Transaction::TRANSACTION_PEDAGANG_MIN);
                    if($transactions != null) {
                        foreach($transactions as $transaction) {
                            $start_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_start);
                            $end_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_end);
                            //check apa order_time_start / order_time_end ada diantara estimation_time_end, and estimation_time_start
                            $checkStart = $start->between($start_old, $end_old);
                            $checkEnd = $end->between($start_old, $end_old);

                            if($checkStart == true || $checkEnd == true) { //klo ada yg in between tampilin error
                                $errors['conflict'] = 'Sorry your booking time is conflict with other transaction of these provider';
                            }
                        }
                    }
                    $data['distance'] = $distance->rows[0]->elements[0]->distance->text;
                    $data['traveling_time'] = $distance->rows[0]->elements[0]->duration->text;
                    $data['estimation_time_start'] = $start;
                    $data['estimation_time_end'] = $end;
                } else { //abang yg stay tetp harus ada estimasi waktu mulai and nga nya yg beda nga ada waktu duration dari google nya
                    $start = Carbon::createFromFormat('H:i:s', $request->order_time);
                    $end = Carbon::createFromFormat('H:i:s', $request->order_time)->addMinutes(Transaction::TRANSACTION_PEDAGANG_MIN);
                    if($transactions != null) {
                        foreach($transactions as $transaction) {
                            $start_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_start);
                            $end_old = Carbon::createFromFormat('H:i:s', $transaction->estimation_time_end);
                            //check apa order_time_start / order_time_end ada diantara estimation_time_end, and estimation_time_start
                            $checkStart = $start->between($start_old, $end_old);
                            $checkEnd = $end->between($start_old, $end_old);

                            if($checkStart == true || $checkEnd == true) { //klo ada yg in between tampilin error
                                $errors['conflict'] = 'Sorry your booking time is conflict with other transaction of these provider';
                            }
                        }
                    }
                    $start = Carbon::createFromFormat('H:i:s', $request->order_time);
                    $end = Carbon::createFromFormat('H:i:s', $request->order_time)->addMinutes(Transaction::TRANSACTION_PEDAGANG_MAX);
                    $data['distance'] = null;
                    $data['traveling_time'] = null;
                    $data['estimation_time_start'] = $start;
                    $data['estimation_time_end'] = $end;            
                }
            }

        if ($errors != null) {
            return $this->errorResponse($errors, 409);
        }

        $transaction = Transaction::create($data);

        // Create notification for service about new order
        $service = User::with('fcm')->findOrFail($request->main_service_id);
        $pushService = $this->sendAndroidNotification($service, ucwords(Transaction::TRANSACTION_CREATED), ucfirst(Transaction::TRANSACTION_SERVICE_CONFIRMATION), Transaction::TRANSACTION_TAG_CREATED);

        // Create notification for buyer about new order
        $buyer = User::with('fcm')->findOrFail(auth()->user()->id);
        $pushBuyer = $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_CREATED), ucfirst(Transaction::TRANSACTION_USER), Transaction::TRANSACTION_TAG_CREATED);

        // Create notification for admin, simpan ke db ke admin yg superadmin aja
        $msgAdmin = Transaction::TRANSACTION_CREATED_ADMIN.$data['order_code'];
        event(new AdminNotificationEvent($msgAdmin));
        $this->admin->notify(new AdminNotification($msgAdmin));

        // Find or create data graphics for buyer
        $graphicBuyer = $this->add(Graphic::GRAPH_USER, $buyer);

        // Find or create data for graphics for service
        $graphicService = $this->add(Graphic::GRAPH_SERVICE, $service);

        return $this->showOne($transaction, 201);
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return $this->showOne($transaction);
    }

    public function updateBuyer(Request $request, $id_transaction) //only can update status_order untuk cancel order ato untuk kirim commentar dan penilaian
    {   
        $errors = array();
        $buyer = User::with('fcm')->findOrFail(auth()->user()->id); //buyer

        $transaction = Transaction::findOrFail($id_transaction);
        $mainservice = User::with('fcm')->findOrFail($transaction->main_service_id);
        $service = Service::where('main_service_id', $transaction->main_service_id)->first();
        
        if($transaction->buyer_id != auth()->user()->id) {
            $errors['unauthorize'] = 'You don\'t have authorize to update these transaction';
        }
        switch (strtolower($transaction->status_order)) {
            case Transaction::TRANSACTION_STATUS_1:
                if($request->has('cancel')) {
                    $transaction['status_order'] = Transaction::TRANSACTION_STATUS_2;
                }
                $pushService = $this->sendAndroidNotification($mainservice, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_CANCEL), Transaction::TRANSACTION_TAG_UPDATED);
                $pushBuyer = $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_CREATED), ucfirst(Transaction::TRANSACTION_USER), Transaction::TRANSACTION_TAG_CREATED);
                break;
            case Transaction::TRANSACTION_STATUS_3:
                if($request->has('cancel')) {
                    $errors['not_allowed'] = 'You can\'t cancel these transaction';
                }
                //kasi komentar sama rating, update data service rating
                $rules = [
                    'satisfaction_level' => 'required|in:'.Service::RATING_BURUK.','.Service::RATING_KURANG.','.Service::RATING_BIASA.','.Service::RATING_CAKEP.','.Service::RATING_MANTAP,
                    'comment' => 'required',
                ];

                $this->validate($request, $rules);
                if($request->has('satisfaction_level')) {
                    $service['rating_total'] = $service['rating_total'] + 1;
                    $service['rating_transactions_total'] = $service['rating_transactions_total'] + $request->satisfaction_level;
                    $service['rating'] = $service['rating_transactions_total'] / $service['rating_total'];
                }
                break;
            default:
                if($request->has('cancel')) {
                    $errors['not_allowed'] = 'You can\'t cancel these transaction';
                }
                break;
        }
        if($errors != null) {
            return $this->errorResponse($errors, 401);
        }
        $service->save();
        $buyer->save();
        $transaction->save();
    }

    public function updateService(Request $request, $id_transaction) { //update status_order, batalin order, isi komentar dan rating 
        $errors = array();
        $service = User::with('fcm')->findOrFail(auth()->user()->id); //service
        $mainservice = MainService::where('id', $service->id)->with('service.category')->first();
        $transaction = Transaction::findOrFail($id_transaction);
        $buyer = User::with('fcm')->findOrFail($transaction->buyer_id);

        if($transaction->main_service_id != auth()->user()->id) {
            $errors['unauthorize'] = 'You don\'t have authorize to update these transaction';
        }

        $rules = [
            'gps_latitude' => 'required|numeric',
            'gps_longitude' => 'required|numeric',
            // 'accepted' => 'required|string',
        ];

        $this->validate($request, $rules);

        $mainservice['gps_latitude'] = $request->gps_latitude;
        $mainservice['gps_longitude'] = $request->gps_longitude;
        switch (strtolower($transaction->status_order)) {
            case Transaction::TRANSACTION_STATUS_1:
                if($request->accepted == Transaction::ACCEPTED_TRANS) {
                    $transaction['status_order'] = Transaction::TRANSACTION_STATUS_6;

                    //change availability of service using eager loading
                    $service = Service::where('main_service_id', $transaction->main_service_id)->first();
                    $service['available'] = Service::UNAVAILABLE_SERVICE;
                    $service->save();

                    if($mainservice->service->location_abang == Service::STAYED_SHOP) {
                        $transaction['status_order'] = Transaction::TRANSACTION_STATUS_7;
                    }
                    //notifikasi user kalo transaksi diterima oleh service
                    $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ACCEPT), Transaction::TRANSACTION_TAG_UPDATED);
                    // retry if fail
                    // retry(3, function() use ($buyer) {
                        // $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ACCEPT), Transaction::TRANSACTION_TAG_UPDATED);
                    // }, 350);
                    //--------------------
                } elseif($request->accepted == Transaction::NOT_ACCEPTED_TRANS) {
                    $transaction['status_order'] = Transaction::TRANSACTION_STATUS_4;

                    //notification for user karena service tolak order
                    // $this->admin->notify(new AdminNotification(Transaction::TRANSACTION_ABORT)); 
                    $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ABORT), Transaction::TRANSACTION_TAG_UPDATED);
                    // retry if fail
                    // retry(3, function() use ($buyer) {
                        // $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ABORT), Transaction::TRANSACTION_TAG_UPDATED);
                    // }, 350);
                    //--------------------

                    //update graphic untuk yg transaksi batal untuk buyer
                    $this->update(Graphic::GRAPH_USER, $buyer, 'cancel'); 
                    
                    //update graphic untuk yg transaksi batal untuk service
                    $this->update(Graphic::GRAPH_SERVICE, $service, 'cancel');

                } else {
                    $errors['required'] = 'Field accepted needed';
                }
                break;
            case Transaction::TRANSACTION_STATUS_6:
                //selain abang yg stayed, abang yg moveable, ojek, taksi, dkk
                $distanceNew = $this->distanceMatrix($buyer->gps_latitude, $buyer->gps_longitude, $mainservice->gps_latitude, $mainservice->gps_longitude);
                if($mainservice->service->category->type == Category::CATEGORY_PEDAGANG) {
                    $distanceNew = $this->distanceMatrixAbang($buyer->gps_latitude, $buyer->gps_longitude, $mainservice->gps_latitude, $mainservice->gps_longitude);
                }

                // retry if fail
                // retry(3, function() use ($buyer, $mainservice) {
                //     $distanceNew = $this->distanceMatrix($buyer->gps_latitude, $buyer->gps_longitude, $mainservice->gps_latitude, $mainservice->gps_longitude);
                // }, 350);
                //--------------------
                var_dump($distanceNew->rows[0]->elements[0]->distance->text);
                if($distanceNew->status == 'OK' && $distanceNew->rows[0]->elements[0]->distance->value <= Transaction::TRANSACTION_MAX_DISTANCE) {
                    //untuk abang yg move
                    if($mainservice->service->location_abang == Service::MOVEABLE_SHOP) {
                        $transaction['status_order'] = Transaction::TRANSACTION_STATUS_7;

                        //notifikasi untuk user
                        $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ON_THE_PROCESS), Transaction::TRANSACTION_TAG_UPDATED);
                        // retry if fail
                        // retry(3, function() use ($buyer) {
                            // $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ABORT), Transaction::TRANSACTION_TAG_UPDATED);
                        // }, 350);
                        //--------------------

                    } else { //untuk kendaraan
                        $transaction['status_order'] = Transaction::TRANSACTION_STATUS_8;

                        //notifikasi untuk user
                        $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ON_THE_WAY), Transaction::TRANSACTION_TAG_UPDATED);
                        // retry if fail
                        // retry(3, function() use ($buyer) {
                            // $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_ON_THE_WAY), Transaction::TRANSACTION_TAG_UPDATED);
                        // }, 350);
                        //--------------------
                    }
                }
                break;
            case Transaction::TRANSACTION_STATUS_7://makanan diproses abang yg stay/moveable
                if($request->accepted == Transaction::ACCEPTED_TRANS) { //dianggap makanan sudah selesai dibuat
                    $transaction['status_order'] = Transaction::TRANSACTION_STATUS_3;

                    //notification bt admin transaksi berhasil
                    // $this->admin->notify(new AdminNotification(Transaction::TRANSACTION_SUCCESS));

                    //notifikasi user transaksi sukses
                    $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                    //retry if fail
                    // retry(3, function() use ($buyer) {
                        // $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                    // }, 350);
                    //-----------------------------------------

                    //notifikasi service transaksi sukses
                    $this->sendAndroidNotification($service, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);

                    //retry if fail
                    // retry(3, function() use ($service) {
                        // $this->sendAndroidNotification($service, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                    // }, 350);
                    //-----------------------------------------

                    //update graphic untuk yg transaksi sukses untuk buyer
                    $result = $this->update(Graphic::GRAPH_USER, $buyer, 'success'); 
                    
                    //update graphic untuk yg transaksi sukses untuk service
                    $result = $this->update(Graphic::GRAPH_SERVICE, $service, 'success');
                } else {
                    $errors['required'] = 'Field accepted needed';
                }

                break;
            case Transaction::TRANSACTION_STATUS_8://ke tujuan untuk kendaraan
                if($mainservice->service->location_abang == null || $mainservice->service->location_abang == Service::MOVEABLE_SHOP) { //selain abang yg stayed
                    $distanceNew = $this->distanceMatrix($transaction->latitude_destination, $transaction->longitude_destination, $mainservice->gps_latitude, $mainservice->gps_longitude);
                    // retry if fail
                    // retry(3, function() use ($transaction, $mainservice) {
                    //     $distanceNew = $this->distanceMatrix($transaction->latitude_destination, $transaction->longitude_destination, $mainservice->gps_latitude, $mainservice->gps_longitude);
                    // }, 350);
                    //--------------------
                    // var_dump($distanceNew->rows[0]->elements[0]->distance->value);
                    if($distanceNew->status == 'OK' && $distanceNew->rows[0]->elements[0]->distance->value <= Transaction::TRANSACTION_MAX_DISTANCE) {//dianggap pesanan berhasil
                        $transaction['status_order'] = Transaction::TRANSACTION_STATUS_3;

                        //notification for admin klo uda beres transaksinya
                        // $this->admin->notify(new AdminNotification(Transaction::TRANSACTION_SUCCESS)); 

                        //notification ke user transaksi berhasil
                        $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                        // retry if fail
                        // retry(3, function() use ($buyer) {
                            // $pushBuyer = $this->sendAndroidNotification($buyer, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                        // }, 350);
                        //--------------------

                        //notification ke service transaksi berhasil
                        $this->sendAndroidNotification($service, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                        // retry if fail
                        // retry(3, function() use ($service) {
                            // $this->sendAndroidNotification($service, ucwords(Transaction::TRANSACTION_UPDATED), ucfirst(Transaction::TRANSACTION_SUCCESS), Transaction::TRANSACTION_TAG_UPDATED);
                        // }, 350);
                        //--------------------

                        //update graphic untuk yg transaksi sukses untuk buyer
                        $this->update(Graphic::GRAPH_USER, $buyer, 'success'); 
                        
                        //update graphic untuk yg transaksi sukses untuk service
                        $this->update(Graphic::GRAPH_SERVICE, $service, 'success');
                    } 
                }
                
                break;
            default:
                break;
        }
        $mainservice->save();
        $transaction->save();

        if($errors != null) {
            return $this->errorResponse($errors, 409);
        }

        return $this->showOne($transaction);

    }

    public function updatePriority(Request $request) {
        foreach($request->transactions as $transaction) {
            $find = Transaction::findOrFail($transaction->id);
            $find['priority'] = $transaction->priority;
            $find->save();
        }
        $today = Carbon::now()->toDateString();
        $user = Auth::user()->id;
        $transactions = Transaction::where('main_service_id', $user)->where('order_date', $today)->sortBy('priority');
        return response()->json([
                'data' => $priority,
            ], 200);
    }

    public function destroyBuyer(Request $request) //bentuk nya arrays
    {
        $transactions = Transaction::where('buyer_id', auth()->user()->id)->whereIn('status_order', [Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_3, Transaction::TRANSACTION_STATUS_4])->get();
        if($transactions->first() == null) {
            return $this->errorResponse('Transaction with status success or abort not found', 404);
        }
        // $angka = implode(",", $transactions->pluck('id')->toArray());
        $rules = [
            'id_transaction.*' => 'required|in:'.implode(",", $transactions->pluck('id')->toArray()),
        ];

        $this->validate($request, $rules);

        $findTransactions = Transaction::whereIn('status_order', [Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_3, Transaction::TRANSACTION_STATUS_4])->whereIn('id', $request->id_transaction)->get();
        // return response()->json($findTransactions);
        foreach($findTransactions as $transaction) {
            $transaction->delete();
        }

        return response()->json([
            'data' => 'Success deleted transactions',
            'status' => 'OK',
            ], 200);
    }

    public function destroyService(Request $request) //bentuk nya arrays
    {
        $transactions = Transaction::where('main_service_id', auth()->user()->id)->whereIn('status_order', [Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_3, Transaction::TRANSACTION_STATUS_4])->get();
        if($transactions->first() == null) {
            return $this->errorResponse('Transaction with status success or abort not found', 404);
        }
        // $angka = implode(",", $transactions->pluck('id')->toArray());
        $rules = [
            'id_transaction.*' => 'required|in:'.implode(",", $transactions->pluck('id')->toArray()),
        ];

        $this->validate($request, $rules);

        $findTransactions = Transaction::whereIn('status_order', [Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_3, Transaction::TRANSACTION_STATUS_4])->whereIn('id', $request->id_transaction)->get();
        // return response()->json($findTransactions);
        foreach($findTransactions as $transaction) {
            $transaction->delete();
        }

        return response()->json([
            'data' => 'Success deleted transactions',
            'status' => 'OK',
            ], 200);
    }
}
