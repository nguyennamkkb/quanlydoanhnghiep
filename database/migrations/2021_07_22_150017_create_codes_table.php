<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            // ma dang ky tai
            $table->id();
            $table->string('code');
            $table->boolean('isUsed')->default(false);
            $table->integer('enterprise_id')->nullable();
            $table->dateTime('startTime')->nullable();
            $table->dateTime('endTime')->nullable();
            $table->timestamps();

            // $table->foreign('idEnterprise')->references('id')->on('enterprises');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
}
