<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userpermissons', function (Blueprint $table) {
            $table->integer('idUser');  
            $table->integer('idPerm');  

            // $table->foreign('idUser')->references('id')->on('users');
            // $table->foreign('idPerm')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user__permissons');
    }
}
