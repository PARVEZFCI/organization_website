<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('profile_picture')->nullable();

            $table->string('course_name')->nullable();
            $table->string('intake_no')->nullable();
            $table->integer('passing_year')->nullable();

            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('organization')->nullable();
            $table->text('office_address')->nullable();

            $table->string('membership_type');
            $table->string('payment_type');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('payment_method')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memberships');
    }
};
