<?php

use App\Advertisement;
use App\Armada;
use App\Buyer;
use App\Category;
use App\City;
use App\FCM;
use App\Favorite;
use App\MainService;
use App\Message;
use App\MessageDetail;
use App\Notification;
use App\Other;
use App\Province;
use App\Service;
use App\Transaction;
use App\User;
use Carbon\Carbon;
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
        'gender' => $faker->randomElement([User::FEMALE_GENDER, User::MALE_GENDER]),
        'phone' => '085721024770',
        'city_id' => 1,
        'province_id' => 1,
        'profile_image' => 'pp.jpeg',
        'verified' => $verified = '1',
        'verification_link' => $verified == User::VERIFIED_USER ? null : User::generateVerificationPhone(),
        'reset_password' => null,
        'admin' => User::REGULER_USER,
        'invite_friends' => $faker->randomElement([2, 4, 6, 8, 10]),
        'gps_latitude' => -6.9053654,
        'gps_longitude' => 107.6157788,
        'expired_at' => Carbon::now()->addDays(60),
        'payment' => User::TRIAL_PAYMENT,
        // 'status' => User::USER_ACTIVE,
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
        'verified_service' => '1',
        'vehicle_type' => $faker->word,
        'category_id' => $idCategory = Category::inRandomOrder()->first()->id,
        // 'setting_mode' => '1',
        'status' => '1', 
        'available' => '1',
        'location_abang' => null,
        'expired_at' => Carbon::now()->addDays(60),
    ];
});

$factory->define(Message::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6),
        'user_id' => $faker->randomElement([1,2,3,4]),
        'read_admin' => Message::UNREAD_MESSAGE,
        'read_user' => Message::UNREAD_MESSAGE,
        'deleted_by_user' => null,
        'deleted_by_admin' => null,
    ];
});

$factory->define(MessageDetail::class, function (Faker\Generator $faker) {
    $message = Message::where('user_id', 1)->get()->first();
    return [
        'message_id' => $message->id,
        'user_id' => $message->user_id, 
        'admin_id' => 0,
        'content' => $faker->paragraph($nbSentences = 3),
        'read_admin' => MessageDetail::UNREAD_MESSAGEDETAILS,
        'read_user' => MessageDetail::UNREAD_MESSAGEDETAILS,
        'deleted_by_user' => null,
        'deleted_by_admin' => null,
    ];
});



$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'type' => 'kendaraan',
        'category_type' => 'taksi',
        'subcategory_type' => 'gemah ripah',
        'tags' => 'taksi',
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

$factory->define(Province::class, function (Faker\Generator $faker) {
    return [
        'name_province' => 'jawa barat',
    ];
});

$factory->define(City::class, function (Faker\Generator $faker) {
    return [
        'name_city' => 'bandung',
        'province_id' => 1,
    ];
});

$factory->define(Other::class, function (Faker\Generator $faker) {
    return [
        'invite_friends' => 10,
        'trial_days' => 60,
        'buying_days' => 365,
        'share_days' => 90,
        'price_year_user' => 275000,
        'price_full_user' => 300000,
        'price_year_service' => 375000,
        'price_full_service' => 450000,
    ];
});

$factory->define(Advertisement::class, function (Faker\Generator $faker) {
    return [
        'ads_image' => '1.jpg',
        'click_count' => $faker->randomElement([12,35,21,7]),
        'showing_count' => $faker->randomElement([1,2,3,4]), 
    ];
});

$factory->define(FCM::class, function (Faker\Generator $faker) {
    return [
        'fcm_registration_token' => 'dsq3yElx8pQ:APA91bFeL18hcNUy3EOc0bHiDxtI1d16kDjlGDbZcGLNptNBSEZhupr2VmKGBcXNuru75LaPAzNbUAAjL5DleKrVAU_uS9ZdXr6xiRTafNff79HTsfuHathUPSf6BjiJj0actw60ydVs',
        'user_id' => 101,
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
        'order_date' => Carbon::now()->toDateString(),
        'order_time' => Carbon::now()->toTimeString(),
        'status_order' => Transaction::TRANSACTION_STATUS_5, 
        'satisfaction_level' => null,
        'comment' => null,
        'current_destination' => $faker->streetAddress,
        'final_destination' => $faker->streetAddress,
        'latitude_current' =>$faker->latitude($min = -90, $max = 90),
        'longitude_current' =>$faker->longitude($min = -180, $max = 180),
        'latitude_destination' =>$faker->latitude($min = -90, $max = 90),
        'longitude_destination' =>$faker->longitude($min = -180, $max = 180),
        'distance' =>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'traveling_time' =>$faker->randomNumber($nbDigits = 3, $strict = false),
        'estimation_time_start' => Carbon::now()->subMinutes(30),
        'estimation_time_end' => Carbon::now()->addMinutes(30),   
    ];
});
