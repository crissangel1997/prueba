<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoginHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginhistory', function (Blueprint $table) {
             
            $table->increments('idHistory');
            $table->datetime('LoginDateTime')->nullable();
            $table->datetime('LogoutDateTime')->nullable();
           // $table->integer('user_id')->unsigned();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('HostName')->nullable();
            $table->String('Description')->nullable();
            $table->integer('Active')->default(1);
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
        Schema::dropIfExists('loginhistory');
    }
}
