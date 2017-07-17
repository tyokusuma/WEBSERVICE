<?php

use App\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_service_id')->unsigned()->unique();
            $table->string('service_code', 11); 
            $table->string('ktp_image', 255);
            $table->string('sim_image', 255)->nullable();
            $table->string('stnk_image', 255)->nullable();
            $table->string('vehicle_image', 255);
            $table->string('license_platenumber', 255)->nullable(); 
            $table->string('verified_service', 1); 
            $table->string('vehicle_type', 255)->nullable(); 
            $table->string('setting_mode', 1);
            $table->string('status', 1);
            $table->string('available', 1);
            $table->string('armada', 1)->nullable();
            $table->string('id_driver')->nullable();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('main_service_id')->references('id')->on('users');
            $table->softDeletes();
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
