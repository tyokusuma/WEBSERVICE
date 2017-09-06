<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('read_admin', 1);
            $table->string('read_user', 1);
            $table->unsignedInteger('admin_created')->nullable();
            $table->unsignedInteger('admin_updated')->nullable();
            $table->unsignedInteger('deleted_by_admin')->nullable();
            $table->timestamp('deleted_by_user')->nullable();
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
