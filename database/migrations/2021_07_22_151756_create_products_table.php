<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('idUnit');
            $table->integer('idSupplie');
            $table->string('barcode');
            $table->string('qrcode');
            $table->timestamps();

            // $table->foreign('idUnit')->references('id')->on('enterprises');
            // $table->foreign('idSupplie')->references('id')->on('enterprises');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
