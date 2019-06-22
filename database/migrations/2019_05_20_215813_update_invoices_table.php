<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('invoice_items', function(Blueprint $table){
          $table->string("INIT_ITEM")->nullable();
          $table->integer("INIT_CONT")->default(1);
        });
        Schema::table('invoices', function(Blueprint $table){
          $table->smallInteger("INVC_STAT")->default(0);
          $table->double("INVC_TOTL_GOLD")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('invoice_items', function(Blueprint $table){
        $table->dropColumn("INIT_ITEM");
        $table->dropColumn("INIT_CONT");
      });
      Schema::table('invoices', function(Blueprint $table){
        $table->dropColumn("INVC_STAT");
        $table->dropColumn("INVC_TOTL_GOLD");
      });
    }
}
