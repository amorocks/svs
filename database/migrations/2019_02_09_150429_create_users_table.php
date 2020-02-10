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
            $table->string('id')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('type');

            $table->integer('level')->default(0);
            $table->date('started')->nullable();
            $table->date('finished')->nullable();
            $table->string('mentor_id')->nullable();
            $table->bigInteger('unit_id')->unsigned()->nullable();

            $table->rememberToken();
            $table->timestamps();


            $table->primary('id');
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
