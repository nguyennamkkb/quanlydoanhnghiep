<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_enterprises', function (Blueprint $table) {
            $table->integer('idUser');
            $table->integer('idEnterprise');

            // $table->foreign('idUser')->references('id')->on('users');
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
        Schema::dropIfExists('user__enterprises');
    }
}
