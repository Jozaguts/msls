<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchLineupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_lineup_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('match_lineup_id');
            $table->foreign('match_lineup_id')->references('id')->on('match_lineups')->onDelete('cascade');

            $table->unsignedBigInteger('match_actions');
            $table->foreign('match_action_id')->references('id')->on('match_actions')->onDelete('cascade');

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
