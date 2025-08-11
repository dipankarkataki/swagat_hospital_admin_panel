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
        Schema::create('lab_test_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_test_category_id');
            $table->string('name');
            $table->text('description');
            $table->json('lab_test_id');
            $table->decimal('full_price', 8, 2);
            $table->integer('discount')->nullable();
            $table->decimal('discounted_price', 8, 2)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lab_test_category_id')->references('id')->on('lab_test_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_packages');
    }
};
