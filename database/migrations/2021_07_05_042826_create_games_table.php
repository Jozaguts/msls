<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('result',['W','L','D']);
            $table->string('score');
            $table->unsignedBigInteger('mvp');
            $table->foreign('mvp')->references('id')->on('players')->onDelete('cascade');
            $table->unsignedBigInteger('referee_id');
            $table->foreign('referee_id')->references('id')->on('referees')->onDelete('cascade');
            $table->time('stop1');
            $table->time('stop2');
            $table->softDeletes();

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
        Schema::dropIfExists('games');
    }
}
