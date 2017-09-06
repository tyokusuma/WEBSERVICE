<?php

use App\Other;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger(Other::OTHER_1);
            $table->unsignedInteger(Other::OTHER_2);
            $table->unsignedInteger(Other::OTHER_3);
            $table->unsignedInteger(Other::OTHER_4);
            $table->string(Other::OTHER_5);
            $table->string(Other::OTHER_6);
            $table->string(Other::OTHER_7);
            $table->string(Other::OTHER_8);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('others');
    }
}
