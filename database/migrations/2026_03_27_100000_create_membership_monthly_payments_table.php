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
        Schema::create('membership_monthly_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_id')->constrained('memberships')->onDelete('cascade');
            $table->integer('month'); // 1-12
            $table->integer('year'); // e.g., 2026
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('status', ['paid', 'due'])->default('due');
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_method')->nullable(); // bkash, cash, bank_transfer, etc.
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Ensure unique payment record per member per month
            $table->unique(['membership_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_monthly_payments');
    }
};
