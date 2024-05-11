<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('tours', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('country_id');
             $table->string('route');
             $table->unsignedBigInteger('ticket_id');
             $table->string('description');
             $table->unsignedBigInteger('tour_operator_id');
             $table->unsignedBigInteger('hotel_id');
             $table->string('img')->nullable();  
             
             $table->foreign('country_id')->references('id')->on('countries');
             $table->foreign('ticket_id')->references('id')->on('tickets');
             $table->foreign('tour_operator_id')->references('id')->on('tour__operators');
             $table->foreign('hotel_id')->references('id')->on('hotels');

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
         Schema::dropIfExists('tours');
     }
};
