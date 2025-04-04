<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates_assigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('certificate_id'); // foreign key or regular column
            $table->unsignedBigInteger('user_id'); // foreign key or regular column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates_assign');
    }
};
