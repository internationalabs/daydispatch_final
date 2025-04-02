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
        DB::unprepared('
        CREATE TRIGGER tr_All_User_Listings_Logs AFTER UPDATE ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO update_logs (`column_name`, `old_value`, `new_value`, `updated_at`) 
                VALUES (3, NEW.id, now(), null);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared('DROP TRIGGER `tr_All_User_Listings_Logs`');
    }
};
