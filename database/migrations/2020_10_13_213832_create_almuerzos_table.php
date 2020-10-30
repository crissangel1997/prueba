<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmuerzosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almuerzos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('description')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps(); 
            $table->integer('visit_id')->unsigned();
            $table->foreign('visit_id')->references('id')->on('visitas');
           
           
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('malmuerzo_id')->references('id')->on('menu_almuerzos')->onDelete('cascade');

        
        });
          
             
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almuerzos');
       
    }
}
