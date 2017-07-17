<?php

use App\Advertisement;
use App\Armada;
use App\Category;
use App\Favorite;
use App\Message;
use App\MessageDetail;
use App\Notification;
use App\Other;
use App\Province;
use App\Service;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

    	User::truncate();
    	Transaction::truncate();
        Service::truncate();
        Message::truncate();
        MessageDetail::truncate();
        Notification::truncate();
        Favorite::truncate();
        Category::truncate();
        Province::truncate();
        Armada::truncate();
        Other::truncate();
        Advertisement::truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Transaction::flushEventListeners();
        Favorite::flushEventListeners();
        Service::flushEventListeners();
        Message::flushEventListeners();
        MessageDetail::flushEventListeners();
        Notification::flushEventListeners();
        Province::flushEventListeners();
        Armada::flushEventListeners();
        Other::flushEventListeners();
        Advertisement::flushEventListeners();

    	$userQty = 300;
    	$serviceQty = 100;
    	$transactionQty = 500;
    	$favoriteQty = 150;
    	$categoryQty = 20;
        $messageQty = 10;
        $messageDetailQty = 15;
        $notificationQty =10;
        $provinceQty = 30;
        $armadaQty = 22;
        $otherQty = 1;
        $adsQty = 5;

        factory(User::class, $userQty)->create();
        factory(Category::class, $categoryQty)->create();       
        factory(Service::class, $serviceQty)->create();
    	factory(Favorite::class, $favoriteQty)->create();
        factory(Message::class, $messageQty)->create();
        factory(MessageDetail::class, $messageDetailQty)->create();
        factory(Notification::class, $notificationQty)->create();
        factory(Province::class, $provinceQty)->create();
        factory(Armada::class, $armadaQty)->create();
        factory(Other::class, $otherQty)->create();
        factory(Advertisement::class, $adsQty)->create();
        factory(Transaction::class, $transactionQty)->create();
    }
}
