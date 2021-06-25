<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldCoinAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coin_address', function (Blueprint $table) {
            $table->dropColumn(['currency']);
            $table->integer('status')->default(getConfig('coin_address_status_not_used'));
            $table->string('private_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coin_address', function (Blueprint $table) {
            $table->string('currency');
            $table->dropColumn('status');
            $table->dropColumn('private_key');
        });
    }
}