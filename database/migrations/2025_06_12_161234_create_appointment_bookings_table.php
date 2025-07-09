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
        Schema::create('appointment_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique();
            $table->unsignedBigInteger('portfolio_id');
            $table->unsignedBigInteger('hospital_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('zipcode');
            $table->date('dob');
            $table->string('gender');
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_bookings');
    }
};
