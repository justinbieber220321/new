<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('username');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('gender')->nullable()->default(2)->comment('1 boy, 2 girl');
            $table->string('address')->nullable();
            $table->string('short_description')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('affiliate')->nullable();
            $table->decimal('balance', 15, 3);
            $table->integer('status')->nullable()->default(statusOn())->comment('1: active, 2 block, 3 waiting active email');
            $table->string('remember_password')->nullable();
            $table->string('code_otp')->nullable();
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
        Schema::dropIfExists('user');
    }
}