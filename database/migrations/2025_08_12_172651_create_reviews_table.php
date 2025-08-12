<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //review table is to store ratings and reviews for vendors
        //it will help users to choose the best vendor for their events
        Schema::create('reviews', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('user_id');   // reviewer
           $table->unsignedBigInteger('vendor_id'); // reviewed vendor
           $table->text('review');                  // honest review text
           $table->unsignedTinyInteger('rating');   // rating out of 5
         $table->timestamps();

        // Foreign keys
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

          $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
