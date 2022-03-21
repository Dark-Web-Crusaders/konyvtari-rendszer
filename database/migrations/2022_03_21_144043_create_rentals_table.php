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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            // ki mit/miket mikor határidő
            $table->bigInteger('memberID')->unsigned();
            $table->bigInteger('bookID')->unsigned();
            $table->date('created_at');
            $table->date('deadline');
            $table->foreign('memberID')->references('id')->on('members');
            $table->foreign('bookID')->references('id')->on('books');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};
