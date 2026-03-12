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
        Schema::table('bylaws', function (Blueprint $table) {
            $table->string('title')->nullable()->after('content');
            $table->enum('file_type', ['pdf', 'image'])->nullable()->after('title');
            $table->string('file_path')->nullable()->after('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bylaws', function (Blueprint $table) {
            $table->dropColumn(['title', 'file_type', 'file_path']);
        });
    }
};
