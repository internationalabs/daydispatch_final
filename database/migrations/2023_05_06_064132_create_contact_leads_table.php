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
        Schema::create('contact_leads', function (Blueprint $table) {
            $table->id();
            $table->string('Lead_Name');
            $table->string('Lead_Email');
            $table->string('Lead_Phone');
            $table->string('Lead_Subject');
            $table->text('Lead_Message');
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
        Schema::dropIfExists('contact_us');
    }
};
