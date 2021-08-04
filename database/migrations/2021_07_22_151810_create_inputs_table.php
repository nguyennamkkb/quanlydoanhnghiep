<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date'); 
            $table->integer('supplier_id'); 
            $table->string('totalweight_id'); 
            $table->integer('importer_id'); 
            $table->integer('carrier_id'); 
            $table->timestamps();

            // $table->foreign('idImporter')->references('id')->on('users');
            // $table->foreign('idCarrier')->references('id')->on('users');
            // $table->foreign('idSupblie')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inputs');
    }
}
