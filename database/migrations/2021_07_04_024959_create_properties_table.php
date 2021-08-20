<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('address');
            $table->string('type');
            $table->tinyInteger('bedrooms')->unsigned();
            $table->tinyInteger('bathrooms')->unsigned();
            $table->tinyInteger('half_bathrooms')->unsigned();
            $table->smallInteger('space')->unsigned();
            $table->text('description');
            $table->boolean('pets_allowed');
            $table->date('available_at');
            $table->unsignedSmallInteger('rental_period_in_months');
            $table->mediumInteger('monthly_rent')->unsigned();
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
        Schema::dropIfExists('properties');
    }
}
