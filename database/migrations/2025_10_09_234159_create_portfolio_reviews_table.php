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
        Schema::create('portfolio_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');
            $table->string('name');
            $table->text('review');
            $table->integer('rating');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_reviews');
    }
};
