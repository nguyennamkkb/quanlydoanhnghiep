<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterpriseCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_customers', function (Blueprint $table) {
            $table->integer('enterprise_id');
            $table->integer('customer_id');

            // $table->foreign('idEnterprise')->references('id')->on('enterprises');
            // $table->foreign('idCustomer')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enterprise__customers');
    }
}
