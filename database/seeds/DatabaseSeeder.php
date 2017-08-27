<?php

use App\Advertisement;
use App\Armada;
use App\Category;
use App\City;
use App\Favorite;
use App\Message;
use App\MessageDetail;
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
        Favorite::truncate();
        Category::truncate();
        Province::truncate();
        Armada::truncate();
        Other::truncate();
        Advertisement::truncate();
        City::truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Transaction::flushEventListeners();
        Favorite::flushEventListeners();
        Service::flushEventListeners();
        Message::flushEventListeners();
        MessageDetail::flushEventListeners();
        Province::flushEventListeners();
        Armada::flushEventListeners();
        Other::flushEventListeners();
        Advertisement::flushEventListeners();
        City::flushEventListeners();

    	$userQty = 100;
    	$serviceQty = 30;
    	$transactionQty = 250;
    	$favoriteQty = 100;
    	$categoryQty = 10;
        $messageQty = 10;
        $messageDetailQty = 15;
        $provinceQty = 30;
        $armadaQty = 10;
        $otherQty = 1;
        $adsQty = 5;
        $cityQty = 35;

        factory(User::class, $userQty)->create();
        factory(Category::class, $categoryQty)->create();       
        factory(Service::class, $serviceQty)->create();
    	factory(Favorite::class, $favoriteQty)->create();
        factory(Message::class, $messageQty)->create();
        factory(MessageDetail::class, $messageDetailQty)->create();
        factory(Province::class, $provinceQty)->create();
        factory(City::class, $cityQty)->create();
        factory(Armada::class, $armadaQty)->create();
        factory(Other::class, $otherQty)->create();
        factory(Advertisement::class, $adsQty)->create();
        factory(Transaction::class, $transactionQty)->create();
    }
}
