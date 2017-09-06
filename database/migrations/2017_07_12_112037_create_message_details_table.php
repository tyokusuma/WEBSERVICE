<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('admin_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('read_admin', 1);
            $table->string('read_user', 1);
            $table->unsignedInteger('deleted_by_admin')->nullable();
            $table->timestamp('deleted_by_user')->nullable();
            $table->timestamps();
            
            $table->softDeletes();
            $table->foreign('message_id')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_details');
    }
}
