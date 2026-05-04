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
        Schema::create('past_committee_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('past_committee_period_id')
                ->constrained('past_committee_periods')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('designation');
            $table->string('image')->nullable();
            $table->unsignedInteger('serial')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('past_committee_members');
    }
};
