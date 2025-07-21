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
        Schema::table('lab_test_payments', function (Blueprint $table) {
            $table->string('payment_status')->after('amount');
            $table->string('patient_name')->after('payment_status');
            $table->string('patient_email')->after('patient_name');
            $table->string('patient_phone')->after('patient_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lab_test_payments', function (Blueprint $table) {
            //
        });
    }
};
