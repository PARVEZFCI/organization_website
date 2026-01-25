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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donation_fund');
            $table->string('phone_email');
            $table->decimal('amount', 10, 2);
            $table->string('payment_id')->nullable();
            $table->string('trx_id')->nullable();
            $table->string('transaction_status')->default('Pending');
            $table->text('bkash_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
