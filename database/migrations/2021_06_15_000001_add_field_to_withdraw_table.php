<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw', function (Blueprint $table) {
            $table->integer('type')->after('number')->nullable()->default(1)->comment('1: transfer, 2: fee, 3: withdraw (hash)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdraw', function($table) {
            $table->dropColumn('type');
        });
    }
}