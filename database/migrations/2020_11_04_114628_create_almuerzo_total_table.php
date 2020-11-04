<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmuerzoTotalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almuerzo_total', function (Blueprint $table) {
            $table->id();
            $table->foreignId('almuerzo_id')->references('id')->on('almuerzos')->onDelete('cascade')->nullable();
            $table->foreignId('visit_id')->references('id')->on('visitas')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('malmuerzo_id')->references('id')->on('menu_almuerzos')->onDelete('cascade');
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
        Schema::dropIfExists('almuerzo_total');
    }
}
