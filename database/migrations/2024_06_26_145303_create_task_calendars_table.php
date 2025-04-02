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
        Schema::create('task_calendars', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('task_title');
            $table->date('task_date'); // Date data type for task_date
            $table->time('task_time'); // Time data type for task_time
            $table->text('task_description');
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
        Schema::dropIfExists('task_calendars');
    }
};
