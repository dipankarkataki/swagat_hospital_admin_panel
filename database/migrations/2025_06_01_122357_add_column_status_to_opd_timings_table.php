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
           $table->boolean('status')->default(1)->after('opd_end_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opd_timings', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('opd_end_time');
        });
    }
};
