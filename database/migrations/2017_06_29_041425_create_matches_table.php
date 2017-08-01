<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('match_id');
            $table->string('home');
            $table->string('away');
            $table->integer('home_rate');
            $table->integer('draw_rate');
            $table->integer('away_rate');
            $table->integer('home_score');
            $table->integer('away_score');
            $table->date('closing_bet_time');
            $table->date('time_start_match');
            $table->date('time_end_match');
            $table->boolean('public');
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
        Schema::dropIfExists('matches');
    }
}
