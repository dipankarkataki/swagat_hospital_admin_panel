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
        Schema::table('portfolio_recent_events', function (Blueprint $table) {
            $table->string('title')->after('portfolio_id');
            $table->text('description')->after('title')->nullable();
            $table->string('media_thumbnail_link')->after('media_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_recent_events', function (Blueprint $table) {
            //
        });
    }
};
