<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date("LDGR_DATE");
            $table->bigInteger("LDGR_CLNT_ID")->nullable()->unsigned();
            $table->double("LDGR_GD21_AMNT")->default(0);
            $table->double("LDGR_GD18_AMNT")->default(0);
            $table->double("LDGR_MONY_AMNT")->default(0);
            $table->text("LDGR_CMNT")->nullable();
            $table->bigInteger("LDGR_USER_ID")->unsigned();
            $table->double("LDGR_GD18_CURR");
            $table->double("LDGR_GD21_CURR");
            $table->double("LDGR_MONY_CURR");
            $table->double("LDGR_GOLD_CLNT")->nullable();
            $table->double("LDGR_MONY_CLNT")->nullable();
            $table->timestamps();

            $table->foreign("LDGR_CLNT_ID")->references('id')->on('clients');
            $table->foreign("LDGR_USER_ID")->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledger');
    }
}
