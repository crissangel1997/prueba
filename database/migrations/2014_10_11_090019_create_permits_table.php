<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
   
          $table->string('description')->nullable();
            $table->integer('active')->default(1);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('permittype_id')->references('id')->on('permits_types')->onDelete('cascade')->nullable();
            $table->foreignId('permitstatus_id')->references('id')->on('permits_statuses')->onDelete('cascade')->nullable();
            $table->foreignId('useraproval_id')->references('id')->on('users')->onDelete('cascade')->nullable();




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
        Schema::dropIfExists('permits');
    }
}
