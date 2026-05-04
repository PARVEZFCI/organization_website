<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upcoming_events', function (Blueprint $table) {
            $table->string('banner_path')->nullable()->after('details');
            $table->string('venue')->nullable()->after('banner_path');
            $table->string('start_time')->nullable()->after('date');
            $table->string('end_time')->nullable()->after('start_time');
            $table->dateTime('registration_deadline')->nullable()->after('end_time');
            $table->text('registration_notes')->nullable()->after('registration_deadline');
            $table->string('contact_person')->nullable()->after('registration_notes');
            $table->string('contact_phone')->nullable()->after('contact_person');
            $table->boolean('is_registration_enabled')->default(true)->after('contact_phone');
            $table->boolean('requires_payment')->default(true)->after('is_registration_enabled');
            $table->unsignedInteger('max_registrations')->nullable()->after('requires_payment');
            $table->json('fee_config')->nullable()->after('max_registrations');
        });
    }

    public function down(): void
    {
        Schema::table('upcoming_events', function (Blueprint $table) {
            $table->dropColumn([
                'banner_path',
                'venue',
                'start_time',
                'end_time',
                'registration_deadline',
                'registration_notes',
                'contact_person',
                'contact_phone',
                'is_registration_enabled',
                'requires_payment',
                'max_registrations',
                'fee_config',
            ]);
        });
    }
};
