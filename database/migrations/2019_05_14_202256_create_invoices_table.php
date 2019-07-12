<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('INVC_DATE');
            $table->bigInteger("INVC_CLNT_ID");
            $table->double("INVC_TOTL");
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger("INIT_INVC_ID");
          $table->double("INIT_MLLI")->default(0.0);
          $table->double("INIT_GRAM");
          $table->string("INIT_GOLD_TYPE");
          $table->double("INIT_PRCE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_items');
    }
}
