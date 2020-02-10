<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->text('title');
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->bigInteger('rating_scale_id')->unsigned();
            $table->integer('points');
            $table->timestamps();

            $table->foreign('rating_scale_id')
                ->references('id')->on('rating_scales')
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
        Schema::dropIfExists('terms');
    }
}
