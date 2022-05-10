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
        DB::unprepared('CREATE TRIGGER `rentals_return_trigger`
            AFTER UPDATE ON `rentals` FOR EACH ROW
            BEGIN
                DECLARE new_qty INT(11) DEFAULT NULL;     
                IF (new.returned=1) THEN
                    SET new_qty = (SELECT quantity from `books` WHERE id = new.bookID) + 1;
                    UPDATE books SET quantity = new_qty WHERE id = new.bookID;
                END IF;
            END;
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
    }
};
