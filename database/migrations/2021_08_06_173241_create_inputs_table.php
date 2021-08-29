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
            $table->date('date'); 
            $table->integer('category_id'); 
            $table->integer('customer_id'); 
            $table->integer('importer_id'); 
            $table->integer('carrier_id')->nullable(); 
            $table->double('totalmoney',11,0); 
            $table->double('prepay',11,0)->nullable();
            $table->string('note')->nullable(); 
            $table->string('status',2)->default("1"); 
            $table->string('status_export',2)->default("1"); 
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
        Schema::dropIfExists('inputs');
    }
}
