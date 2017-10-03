<?php

use App\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_service_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->string('order_code', 18);
            $table->string('booking', 1);
            $table->date('order_date');
            $table->time('order_time');
            $table->string('status_order');
            $table->string('satisfaction_level')->default(null);
            $table->longText('comment')->nullable(); 
            $table->longText('current_destination'); 
            $table->longText('final_destination');
            $table->double('latitude_current', 11,6); 
            $table->double('longitude_current', 11,6);
            $table->double('latitude_destination', 11,6);
            $table->double('longitude_destination', 11,6);
            $table->integer('priority')->nullable(); //new field
            $table->string('distance')->nullable();
            $table->string('traveling_time')->nullable();//in minute
            $table->dateTime('estimation_time_start')->nullable();
            $table->dateTime('estimation_time_end')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('main_service_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
