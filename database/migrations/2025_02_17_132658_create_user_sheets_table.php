<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('phone_one');
            $table->string('phone_two')->nullable();
            $table->string('phone_three')->nullable();
            $table->string('state');
            $table->text('address');
            $table->string('email')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_sheets');
    }
};
