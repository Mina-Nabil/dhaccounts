<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('WKTN_WKSP_FROM')->unsigned();
            $table->bigInteger('WKTN_WKSP_TO')->unsigned();
            $table->bigInteger("WKTN_USER_ID")->unsigned();
            $table->double('WKTN_GD21')->default(0);
            $table->double('WKTN_GD18')->default(0);
            $table->double('WKTN_MONY')->default(0);
            $table->bigInteger("WKTN_INVT_ID")->nullable();
            $table->integer("WKTN_INVT_CONT")->nullable();
            $table->date("WKTN_DATE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
