<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('otp_code', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');

            $table->string('otp', 5);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('otp_code');
    }
};
