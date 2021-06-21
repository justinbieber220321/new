<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldDefaultValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit', function (Blueprint $table) {
            $table->string('currency')->default(getConfig('coin-default'))->change();
        });
        Schema::table('withdraw', function (Blueprint $table) {
            $table->string('currency')->default(getConfig('coin-default'))->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit', function (Blueprint $table) {
            $table->string('currency')->default('')->change();
        });
        Schema::table('withdraw', function (Blueprint $table) {
            $table->string('currency')->default('')->change();
        });
    }
}