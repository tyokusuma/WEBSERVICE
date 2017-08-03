<?php

namespace App\Providers;

use App\Graphic;
use App\Http\Controllers\Sms\SmsController;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use App\Message;
use App\MessageDetail;
use App\Notification;
use App\Service;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user) {
            $sms = new SmsController();
            $phone = $user->phone;
            $name = $user->full_name;
            $verification_code = $user->verification_link;
            $sms->sendVerificationPhone($phone, $name, $verification_code);
            // Mail::to($user->email)->send(new UserCreated($user));
            // $data['user_id'] = $user->id;
            // $data['title'] = 'New User';
            // $data['content'] = 'A new user with name '.$user->full_name.', and email '.$user->email.' successfully created';
            // $data['read'] = Notification::UNREAD_MESSAGE;
            // Notification::create($data);
        });

        User::updated(function($user) {
            if($user->isDirty('phone')) {
                // retry(5, function() use ($user) {
                //     Mail::to($user)->send(new UserMailChanged($user));
                // }, 100);
                $sms = new SmsController();
                $phone = $user->phone;
                $name = $user->full_name;
                $verification_code = $user->verification_link;
                $sms->sendVerificationPhone($phone, $name, $verification_code);
            }
        });

        Service::updated(function($service) {
            $find = User::find($service->main_service_id)->first();
            if($service->verified == '1') {
                // Mail::to($find)->send(new ServiceVerified($find));
            }
        });

        Transaction::created(function($transaction) {
            // dd($transaction);

            // $created = $transaction->created_at->toDateString();

            // $findService = Graphic::where('date', $created)->first();
            // if ($findService == null) {
            //     $data['user_id'] = $transaction->main_service_id;
            //     $data['date'] = $transaction->created_at->toDateString();
            //     dd($data['date']);
            //     $date['count'] = 1;
            // }
            // $findBuyer = Graphic::where('date', $created)->first();
            // if ($findBuyer == null) {
            //     $data['user_id'] = $transaction->buyer_id;
            //     $data['date'] = $transaction->created_at->toDateString();
            //     dd($data['date']);
            //     $date['count'] = 1;
            // }
            // dd($find);
            // $data['user_id'] = $transaction->buyer_id;
            // $data['title'] = 'New Transaction';
            // $data['content'] = 'A new transaction with id '.$transaction->id.', and status order '.$transaction->status_order.' successfully created';
            // $data['read'] = Notification::UNREAD_MESSAGE;
            // Notification::create($data);
        });

        Transaction::updated(function($transaction) {
            // $data['user_id'] = $transaction->buyer_id;
            // $data['title'] = 'Update Transaction';
            // $data['content'] = 'A transaction with id '.$transaction->id.', had changed into status order '.$transaction->status_order;
            // $data['read'] = Notification::UNREAD_MESSAGE;
            // Notification::create($data);
        });

        Message::created(function($message) {
            // $data['user_id'] = $message->user_id;
            // $data['title'] = 'New Message';
            // $data['content'] = 'A new message from id '.$message->sender_id.', with title '.$message->title;
            // $data['read'] = Notification::UNREAD_MESSAGE;
            // Notification::create($data);
        });

        MessageDetail::created(function($messagedetail) {
            // $data['user_id'] = null;
            // $data['title'] = 'New Reply';
            // $data['content'] = 'A new message reply';
            // $data['read'] = Notification::UNREAD_MESSAGE;
            // Notification::create($data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
