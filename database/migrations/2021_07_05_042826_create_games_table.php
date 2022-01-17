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
            $table->time('time');
            $table->string('location');
            $table->unsignedBigInteger('home_team_id');
            $table->foreign('home_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('away_team_id');
            $table->foreign('away_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('referee_id');
            $table->foreign('referee_id')->references('id')->on('referees')->onDelete('cascade');
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
