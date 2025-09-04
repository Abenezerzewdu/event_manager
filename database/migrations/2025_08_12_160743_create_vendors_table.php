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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            // Foreign key to link vendor to user
             $table->unsignedBigInteger('user_id');
             $table->string('company_name');
             $table->string('contact_email');
             $table->string('phone');
             $table->string('address');
             //admin approval status
             $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->string('description')->nullable();
            $table->binary('vendors_file')->nullable();
            //payment status
            $table->enum('payment_status',['unpaid','paid','refunded'])->default('unpaid');
            //payment package plan
            $table->enum('plan',['basic','premium','elite']);

             $table->timestamps();

             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
