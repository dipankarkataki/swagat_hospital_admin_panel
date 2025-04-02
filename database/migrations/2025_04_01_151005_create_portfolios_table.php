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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('profile_pic');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->integer('experience');
            $table->string('department');
            $table->text('languages_speak')->nullable()->default('Assamese');
            $table->text('brief_description');
            $table->json('expertise')->nullable();
            $table->json('membership')->nullable();
            $table->json('research')->nullable();
            $table->json('awards')->nullable();
            $table->json('available_time_slot')->nullable();
            $table->string('hospital');
            $table->boolean('accepting_appointments')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
