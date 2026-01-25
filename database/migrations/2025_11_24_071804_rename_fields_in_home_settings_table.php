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
        Schema::table('home_settings', function (Blueprint $table) {
            $table->renameColumn('country_select', 'title');
            $table->renameColumn('university_select', 'details');
            $table->dropColumn('career_guidance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_settings', function (Blueprint $table) {
            $table->renameColumn('title', 'country_select');
            $table->renameColumn('details', 'university_select');
            $table->string('career_guidance')->nullable();
        });
    }
};
