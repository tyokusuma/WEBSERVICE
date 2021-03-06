<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_code', 11); 
            $table->string('admin_code', 6)->nullable(); 
            $table->string('full_name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('gender', 1); 
            $table->string('phone');
            $table->unsignedInteger('city_id');
            $table->double('gps_latitude', 11,6)->nullable(); 
            $table->double('gps_longitude', 11,6)->nullable();
            $table->string('profile_image', 255);
            $table->integer('verification_link')->unsigned()->nullable(); 
            $table->string('reset_password')->nullable(); 
            $table->string('verified', 1)->default(User::UNVERIFIED_USER);
            $table->string('admin', 1)->default(User::REGULER_USER);
            $table->integer('invite_friends')->unsigned()->nullable();
            $table->dateTime('expired_at')->nullable(); //buat dapetin token password nanti diganti pake
            $table->dateTime('old_expired_at')->nullable();
            $table->string('payment'); //new field
            // $table->string('status');
            $table->unsignedInteger('admin_created')->nullable();
            $table->unsignedInteger('admin_updated')->nullable();
            //new field
            $table->mediumText('share_newfriends')->nullable();
            $table->mediumText('already_hadfriends')->nullable();
            // --------------
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
