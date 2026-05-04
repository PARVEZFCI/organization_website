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
        Schema::table('membership_monthly_payments', function (Blueprint $table) {
            $table->string('gateway_payment_id')->nullable()->after('payment_method');
            $table->string('transaction_id')->nullable()->after('gateway_payment_id');
            $table->text('gateway_response')->nullable()->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_monthly_payments', function (Blueprint $table) {
            $table->dropColumn(['gateway_payment_id', 'transaction_id', 'gateway_response']);
        });
    }
};
