<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTimeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_time_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->cascadeOnDelete();
            $table->time('first_time_start')->nullable();
            $table->time('first_time_end')->nullable();
            $table->time('second_time_start')->nullable();
            $table->time('second_time_end')->nullable();
            $table->time('prorogue_minutes_start')->nullable();
            $table->time('first_time_extra_time')->nullable();
            $table->time('second_time_extra_time')->nullable();
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
        Schema::dropIfExists('game_time_details');
    }
}
