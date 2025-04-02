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
    public function up(): void
    {
        Schema::create('dispatch_order_fees', static function (Blueprint $table) {
            $table->id();
            $table->string('Payment_Type', 50)->default('Dispatching Order Fee');
            $table->string('Payment_ID');
            $table->tinyInteger('status')->default(0);
            $table->decimal('Payment', 6, 2);
            $table->tinyInteger('Method')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('all_user_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_order_fees');
    }
};
