<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('player_code');
            $table->decimal('turnover', 15, 2);
            $table->decimal('team_turnover', 15, 2);
            $table->decimal('ggr', 15, 2);
            $table->decimal('team_ggr', 15, 2);
            $table->decimal('level', 15, 2);
            $table->decimal('reward', 15, 2);
            $table->decimal('team_reward', 15, 2);
            $table->decimal('matching', 15, 2);
            $table->string('tree');
            $table->timestamp('ins_date')->useCurrent();
            $table->timestamp('upd_date')->nullable();
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
        Schema::dropIfExists('users_detail');
    }
}