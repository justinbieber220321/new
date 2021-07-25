<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateTXStable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TXS', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('player_code')->nullable();
            $table->integer('turnover')->nullable()->default(0);
            $table->integer('team_turnover')->nullable()->default(0);
            $table->integer('ggr')->nullable()->default(0);
            $table->integer('team_ggr')->nullable()->default(0);
            $table->integer('level')->nullable()->default(0);
            $table->integer('team_reward')->nullable()->default(0);
            $table->integer('matching')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TXS');
    }
}
