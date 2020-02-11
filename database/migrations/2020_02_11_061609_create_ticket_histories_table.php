<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('massage');
            $table->unsignedInteger('sender');
            $table->foreign('sender')->references('id')->on('users');
            $table->unsignedInteger('receiver');
            $table->foreign('receiver')->references('id')->on('users');
            $table->unsignedInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets');
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
        Schema::dropIfExists('ticket_histories');
    }
}
