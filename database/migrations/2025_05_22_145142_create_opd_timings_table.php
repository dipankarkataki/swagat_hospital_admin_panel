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
        Schema::create('opd_timings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');
            $table->unsignedBigInteger('hospital_id');
            $table->json('opd_date')->nullable();
            $table->time('opd_start_time')->nullable();
            $table->time('opd_end_time')->nullable();
            $table->timestamps();

            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd_timings');
    }
};
