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
        Schema::table('about_settings', function (Blueprint $table) {
            $table->string('campus_title')->nullable()->after('mission_vission');
            $table->text('campus_description')->nullable()->after('campus_title');
            $table->string('campus_image')->nullable()->after('campus_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn(['campus_title', 'campus_description', 'campus_image']);
        });
    }
};
