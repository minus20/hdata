<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('login')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('role')->default('user');
            $table->string('avatar')->nullable();
            $table->string('vkontakte_id')->nullable();
            $table->string('odnoklassniki_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
