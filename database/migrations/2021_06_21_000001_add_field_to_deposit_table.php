<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit', function (Blueprint $table) {
            $table->integer('type')->after('number')->nullable()->default(getConfig('deposit_type_default', 1))->comment('1: transfer, 3: deposit (hash)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit', function($table) {
            $table->dropColumn('type');
        });
    }
}