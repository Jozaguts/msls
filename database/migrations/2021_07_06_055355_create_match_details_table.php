<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->enum('play_stage',['round','regular','quarter','semis','final']);
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->enum('win_lose',['w','l','d']);
            $table->enum('decided_by', ['normal','penalties']);
            $table->string('goal_score');
            $table->integer('penalty_score');
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
        Schema::dropIfExists('match_details');
    }
}
