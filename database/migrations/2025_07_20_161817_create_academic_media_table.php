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
        Schema::create('academic_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_announcement_id');
            $table->string('type');
            $table->string('photo')->nullable();
            $table->string('doc')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('academic_announcement_id')->references('id')->on('academic_announcements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_media');
    }
};
