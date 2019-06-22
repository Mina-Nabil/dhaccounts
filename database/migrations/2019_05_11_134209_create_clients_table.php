<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('CLNT_NAME');
            $table->string('CLNT_MOB')->nullable();
            $table->string('CLNT_CMNT')->nullable();
            $table->string('CLNT_ADRS')->nullable();
            $table->string('CLNT_SCID')->nullable(); //segel togary
            $table->string('CLNT_ACTP');
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
        Schema::dropIfExists('clients');
    }
}
