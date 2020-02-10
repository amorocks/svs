<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('term_id')->unsigned();
            $table->string('user_id');
            $table->boolean('active')->default(true);
            $table->boolean('finished')->default(false); 
            $table->timestamps();

            $table->foreign('term_id')
                ->references('id')->on('terms')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_user');
    }
}
