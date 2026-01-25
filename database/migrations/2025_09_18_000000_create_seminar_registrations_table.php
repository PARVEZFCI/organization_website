<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seminar_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('course_id');
            $table->string('education');
            $table->text('inquiry_message')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('seminar_registrations');
    }
};
