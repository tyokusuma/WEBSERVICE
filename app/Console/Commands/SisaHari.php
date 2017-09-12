<?php

namespace App\Console\Commands;

use App\Traits\FcmTrait;
use App\User;
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
        $users = User::all();
        foreach ($users as $user) {
            $sisaHari = $user->expired_at->diffInDays(Carbon::now());
            $this->sendAndroidNotification($user, 'Sisa masa aktif', 'Masa aktif tersisa'.$sisaHari, 'user');
        }

        $services = MainService::has('service')->get();
        foreach ($services as $service) {
            $sisaHariService = $service->expired_at->diffInDays(Carbon::now());
            $this->sendAndroidNotification($user, 'Sisa masa aktif', 'Masa aktif tersisa'.$sisaHariService, 'service');
        }


    }
}
