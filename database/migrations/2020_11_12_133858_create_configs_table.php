<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('namec')->nullable();
            $table->string('descriptionc')->nullable();
            $table->time('param1')->nullable();
            $table->time('param2')->nullable();
            $table->integer('param3')->nullable();
            $table->integer('param4')->nullable();
            $table->string('param5')->nullable();
            $table->integer('active')->default(1);

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
        Schema::dropIfExists('configs');
    }
}
