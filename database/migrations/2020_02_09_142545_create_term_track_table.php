<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_track', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('track_id')->unsigned();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('term_id')
                ->references('id')->on('terms')
                ->onDelete('cascade');

            $table->foreign('track_id')
                ->references('id')->on('tracks')
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
        Schema::dropIfExists('term_track');
    }
}
