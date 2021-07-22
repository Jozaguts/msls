<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchLineupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_lineups', function (Blueprint $table) {
            $table->unsignedBigInteger('match_id');
            $table->id();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->boolean('main');


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
        Schema::dropIfExists('match_lineups');
    }
}
