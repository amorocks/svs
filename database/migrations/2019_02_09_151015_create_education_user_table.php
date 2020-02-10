<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('education_id')->unsigned();
            $table->string('user_id');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('education_id')
                ->references('id')->on('educations')
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
        Schema::dropIfExists('education_user');
    }
}
