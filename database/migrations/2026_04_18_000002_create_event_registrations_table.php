<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upcoming_event_id')->constrained('upcoming_events')->cascadeOnDelete();
            $table->foreignId('membership_id')->nullable()->constrained('memberships')->nullOnDelete();
            $table->string('registration_code')->unique();
            $table->string('attendee_source')->default('guest');
            $table->string('membership_type_snapshot')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('position')->nullable();
            $table->string('organization')->nullable();
            $table->unsignedInteger('adult_count')->default(1);
            $table->unsignedInteger('child_count')->default(0);
            $table->unsignedInteger('spouse_count')->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->string('gateway_payment_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->longText('gateway_response')->nullable();
            $table->string('registration_status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
