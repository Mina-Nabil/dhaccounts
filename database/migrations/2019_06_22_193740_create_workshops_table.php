<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("WKSP_NAME");
            $table->text("WKSP_CMNT")->nullable();
            $table->double("WKSP_GD18")->default(0);
            $table->double("WKSP_GD21")->default(0);
            $table->double("WKSP_MONY")->default(0);
            $table->string("WKSP_MOBN")->nullable();
            $table->string("WKSP_ADRS")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
