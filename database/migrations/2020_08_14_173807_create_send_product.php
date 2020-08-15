<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_send', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('id_product')->unsigned();
            $table->foreign('id_product')->references('id')->on('product')->unique();
            $table->smallInteger('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('client')->unique();
            $table->string('status');
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
        Schema::dropIfExists('send_product');
    }
}
