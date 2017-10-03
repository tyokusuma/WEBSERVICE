<?php

namespace App\Console\Commands;

use App\MainService;
use App\Traits\FcmTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SisaHari extends Command
{
    use FcmTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sisahari:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule to send remaining days of apps to each user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::with('fcm')->where('id', '>', 0)->get();
        foreach ($users as $user) {
            $sisaHari = Carbon::createFromFormat('Y-m-d H:i:s', $user->expired_at)->diffInDays(Carbon::now());
            // $this->sendAndroidNotification($user, 'Sisa masa aktif', 'Masa aktif tersisa'.$sisaHari, 'user');
        }

        $mainservices = MainService::has('service')->get()->pluck('id');
        $services = User::with('fcm')->whereIn('id', $mainservices)->get(); 
        foreach ($services as $service) {
            $sisaHariService = Carbon::createFromFormat('Y-m-d H:i:s', $user->expired_at)->diffInDays(Carbon::now());
            $this->sendAndroidNotification($user, 'Sisa masa aktif', 'Masa aktif tersisa'.$sisaHariService, 'service');
        } //masi error karena fcm_token nya nga ada nanti coba testing begitu ada beberapa akun + fcm


    }
}
