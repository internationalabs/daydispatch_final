<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('loadboard_roles', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('account_info')->default(0);
            $table->tinyInteger('profile_edit')->default(0);
            $table->tinyInteger('payment_access')->default(0);
            $table->tinyInteger('load_posting')->default(0);
            $table->tinyInteger('assign_loads')->default(0);
            $table->tinyInteger('carrier_communication')->default(0);
            $table->tinyInteger('shipper_communication')->default(0);
            $table->tinyInteger('rate_carrier')->default(0);
            $table->tinyInteger('update_status')->default(0);
            $table->tinyInteger('search_load')->default(0);
            $table->tinyInteger('bid_loads')->default(0);
            $table->tinyInteger('broker_communication')->default(0);
            $table->tinyInteger('rate_broker')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loadboard_roles');
    }
};
