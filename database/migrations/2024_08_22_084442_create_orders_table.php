<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Listing_Status', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Ref_ID', 255)->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('Custom_Listing')->default(0);
            $table->tinyInteger('Private_Listing')->default(0);
            $table->date('Posted_Date')->nullable();
            $table->tinyInteger('Listing_Type')->default(0);
            $table->tinyInteger('Is_Rate')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->integer('vehicle_count')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('expire_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
