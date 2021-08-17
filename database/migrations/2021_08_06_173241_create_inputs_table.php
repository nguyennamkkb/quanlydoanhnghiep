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
            $table->integer('carrier_id'); 
            $table->float('totalmoney'); 
            $table->float('prepay')->nullable();
            $table->string('note')->nullable(); 
            $table->boolean('status')->default(0); 
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
