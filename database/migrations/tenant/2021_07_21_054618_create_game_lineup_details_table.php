<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameLineupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_lineup_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('game_lineup_id');
            $table->foreign('game_lineup_id')->references('id')->on('game_lineups')->onDelete('cascade');

            $table->unsignedBigInteger('game_action_id');
            $table->foreign('game_action_id')->references('id')->on('game_actions')->onDelete('cascade');

            $table->dateTime('time');

            $table->enum('action_schedule', ['normal','stoppage','extra_time']);
            $table->enum('action_half',['time_1','time_2',]);

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
        Schema::dropIfExists('match_lineup_details');
    }
}
