<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('to');
            $table->string('currency');
            $table->string('address_to')->nullable();
            $table->string('message')->nullable();
            $table->decimal('number', 15, 3);
            $table->timestamp('ins_date')->useCurrent();
            $table->char('del_flag')->default(0)->comment('deleted:1, active:0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw');
    }
}