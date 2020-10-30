<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cenas', function (Blueprint $table) {
            $table->id();
            $table->date('fechac')->nullable();
            $table->string('descriptionc')->nullable();
            $table->integer('active')->default(1);

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('menucena_id')->references('id')->on('menu_cenas')->onDelete('cascade');
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
        Schema::dropIfExists('cenas');
    }
}
