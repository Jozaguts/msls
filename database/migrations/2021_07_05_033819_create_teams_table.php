<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->enum('group', ['a','b','c','d','e','f','g','h','i','j'])->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer('won');
            $table->integer('draw');
            $table->integer('lost');
            $table->integer('goals_against');
            $table->integer('goals_for');
            $table->integer('goals_difference');
            $table->integer('points');
            $table->integer('group_position');
            $table->integer('table_position');
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
