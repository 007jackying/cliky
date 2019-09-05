<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('availability_id')->references('id')->on('availability');
            $table->dateTime('date');
            $table->string('date_code');
            $table->integer('retailer_id')->references('id')->on('retailers');
            $table->string('product');
            $table->string('current_price');
            $table->string('discount_offer');
            $table->string('image_url');
            $table->integer('department_id')->references('id')->on('departments');
            $table->string('category');
            $table->string('offer_url');
            $table->softDeletes();
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
        Schema::dropIfExists('offers');
    }
}
