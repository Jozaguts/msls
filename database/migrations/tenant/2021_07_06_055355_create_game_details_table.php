<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_details', function (Blueprint $table) {
            // todo refactor esta tabla y game antes de comenzar con los test
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            $table->enum('play_stage',['round','regular','quarter','semis','final']);

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

//            $table->enum('win_lose',['w','l','d']); //define si el equipo en cuestion gano perdio o empato
            $table->enum('decided_by', ['normal','penalties']);
            $table->string('goal_score');
            $table->integer('penalty_score');
            $table->boolean('local');
            $table->unsignedBigInteger('mvp');
            $table->foreign('mvp')->references('id')->on('players')->onDelete('cascade');
            $table->unsignedBigInteger('referee_id');
            $table->foreign('referee_id')->references('id')->on('referees')->onDelete('cascade');
            $table->time('stop1');
            $table->time('stop2');
            $table->unsignedBigInteger('assistant_referee_id');
            $table->foreign('assistant_referee_id')->references('id')->on('assistant_referees')->onDelete('cascade');
            $table->unsignedBigInteger('goalkeeper_id');
            $table->foreign('goalkeeper_id')->references('id')->on('players')->onDelete('cascade');
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
        Schema::dropIfExists('game_details');
    }
}
