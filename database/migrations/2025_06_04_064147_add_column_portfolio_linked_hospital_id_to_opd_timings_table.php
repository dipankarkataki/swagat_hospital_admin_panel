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
        Schema::table('opd_timings', function (Blueprint $table) {
            $table->unsignedBigInteger('portfolio_linked_hospital_id')->after('id');
            $table->foreign('portfolio_linked_hospital_id')->references('id')->on('portfolio_linked_hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opd_timings', function (Blueprint $table) {
            //
        });
    }
};
