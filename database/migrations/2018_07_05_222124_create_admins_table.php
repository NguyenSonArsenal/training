<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('password', 64);
            $table->string('email', 128);
            $table->string('avatar', 128)->nullable();
            $table->string('role_type', 1); // super: 1, admin: 2
            $table->integer('ins_id');
            $table->integer('upd_id')->nullable();
            $table->timestamp('ins_datetime');
            $table->timestamp('upd_datetime')->nullable();
            $table->string('del_flag', 1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
