<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->unsignedInteger('assigned_company')->nullable();
            $table->foreign('assigned_company')->references('id')->on('users');
            $table->unsignedInteger('assigned_employee')->nullable();
            $table->foreign('assigned_employee')->references('id')->on('users');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('status_id')->default(1);
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->unsignedInteger('classification_id');
            $table->foreign('classification_id')->references('id')->on('classifications');
            $table->unsignedInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedInteger('user_rating_id')->nullable();
            $table->foreign('user_rating_id')->references('id')->on('user_ratings')->onDelete('cascade');
            $table->unsignedInteger('damage_degree_id')->nullable();
            $table->foreign('damage_degree_id')->references('id')->on('damage_degrees');
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
        Schema::dropIfExists('tickets');
    }
}
