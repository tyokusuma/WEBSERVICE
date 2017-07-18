<?php

use App\Buyer;
use App\User;
use App\MainService;

use App\Category;
use App\Service;
use App\Transaction;
use App\Favorite;
use App\Message;
use App\Notification;
use App\Armada;
use App\MessageDetail;
use App\Province;
use App\Other;
use App\Advertisement;
// use App\Role;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'remember_token' => str_random(10),    
        'user_code' => str_random(11),
        'admin_code'=> null,
        'full_name'=> $faker->name,
        'email'=> $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'gender' => '0',
        'phone' => 81320561331,
        'profile_image' => 'pp.jpeg',
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_link' => $verified == User::VERIFIED_USER ? null : User::generateVerificationPhone(),
        'reset_password' => $verified == User::VERIFIED_USER ? null : User::generateResetPassword(),
        'admin' => User::REGULER_USER,
        'invite_friends' => $faker->randomElement([2, 4, 6, 8, 10]),
    ];
});

$factory->define(Service::class, function (Faker\Generator $faker) {
    return [
        'main_service_id' => $faker->unique()->randomNumber($nbDigits = 2),
        'service_code' => str_random(11),
        'ktp_image' => '1.jpg',
        'sim_image' => '2.jpg',
        'stnk_image' => '3.jpg',
        'vehicle_image' => '4.jpg',
        'license_platenumber' => str_random(8),
        'verified_service' => $verified = $faker->randomElement([Service::VERIFIED_SERVICE, Service::UNVERIFIED_SERVICE]),
        'vehicle_type' => $faker->word,
        'category_id' => $idCategory = Category::inRandomOrder()->first()->id,
        'setting_mode' => $faker->randomElement([Service::ONLINE_STATUS, Service::OFFLINE_STATUS]),
        'status' => $faker->randomElement([Service::ACTIVE_SERVICE, Service::SUSPEND_SERVICE]), 
        'available' => $faker->randomElement([Service::AVAILABLE_SERVICE, Service::UNAVAILABLE_SERVICE]),
    ];
});

$factory->define(Message::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6),
        'user_id' => $faker->randomElement([1,2,3,4]),
        'read_admin' => Message::UNREAD_MESSAGE,
        'read_user' => Message::UNREAD_MESSAGE,
    ];
});

$factory->define(MessageDetail::class, function (Faker\Generator $faker) {
    $message = Message::where('user_id', 1)->get()->first();
    return [
        'message_id' => $message->id,
        'sender_id' => $message->user_id, 
        'receiver_id' => 0,
        'content' => $faker->paragraph($nbSentences = 3),
        'read_admin' => MessageDetail::UNREAD_MESSAGEDETAILS,
        'read_user' => MessageDetail::UNREAD_MESSAGEDETAILS,
    ];
});

$factory->define(Province::class, function (Faker\Generator $faker) {
    return [
        'name_province' => $faker->paragraph($nbSentences = 1),
        'name_city' => $faker->paragraph($nbSentences = 1),
    ];
});

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'category_type' => $driver = $faker->randomElement(['taksi', 'abang']),
        'subcategory_type' => $driver == 'taxi' ? $faker->randomElement(['bluebird', 'gemah ripah']) : $faker->randomElement(['kolek', 'es buah', 'nasi goreng']),
    ];
});


$factory->define(Favorite::class, function (Faker\Generator $faker) {
    return [
        'buyer_id' => $idService3 = User::inRandomOrder()->first()->id,
        'main_service_id' => $idService = Service::inRandomOrder()->first()->main_service_id,
        'category_id' => Service::where('main_service_id', $idService)->first()->category_id,
    ];
});


$factory->define(Notification::class, function (Faker\Generator $faker) {
    $user = User::inRandomOrder()->first();

    return [
        'user_id' => $user->id,
        'title' => 'Complain',
        'content' => 'A user successfully created',
        'read' => '0',
    ];
});

$factory->define(Armada::class, function (Faker\Generator $faker) {
$increment = 0;
    $increment++;
    return [
        'company_name' => 'Blue Bird',
        'id_driver' => 'BB'.$increment,
        'driver_name' => $faker->name,
        'vehicle_platenumber' => 'B 1234 OK',        
    ];
});

$factory->define(Other::class, function (Faker\Generator $faker) {
    return [
        'invite_friends' => 10,
        'yearly_price' => 225000,
        'selling_price' => 675000,
    ];
});

$factory->define(Advertisement::class, function (Faker\Generator $faker) {
    return [
        'ads_image' => '1.jpg',
        'click_count' => $faker->randomElement([12,35,21,7]),
        'showing_count' => $faker->randomElement([1,2,3,4]), 
    ];
});

$factory->define(Transaction::class, function (Faker\Generator $faker) {
    $mainservices = MainService::has('service')->get()->pluck('id');
    $service = Service::inRandomOrder()->first();
    return [
        'main_service_id' => $idService2 = $service->main_service_id,
        'buyer_id' => $idUser2 = User::whereNotIn('id', $mainservices)->inRandomOrder()->first(),
        'order_code' => $faker->ean8,
        'booking' => $faker->randomElement([Transaction::BOOKING, Transaction::NOT_BOOKING]),
        'order_date' => '2017-06-15',
        'order_time' => '18:22:30',
        'status_order' => $faker->randomElement([Transaction::TRANSACTION_STATUS_1, Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_3]), 
        'satisfaction_level' => $faker->randomElement([Transaction::SATISFACTION_LEVEL_1, Transaction::TRANSACTION_STATUS_2, Transaction::TRANSACTION_STATUS_3]),
        'comment' => null,
        'current_destination' => $faker->streetAddress,
        'final_destination' => $faker->streetAddress,
        'latitude_current' =>$faker->latitude($min = -90, $max = 90),
        'longitude_current' =>$faker->longitude($min = -180, $max = 180),
        'latitude_destination' =>$faker->latitude($min = -90, $max = 90),
        'longitude_destination' =>$faker->longitude($min = -180, $max = 180),
        'distance' =>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'traveling_time' =>$faker->randomNumber($nbDigits = 3, $strict = false),
    ];
});
