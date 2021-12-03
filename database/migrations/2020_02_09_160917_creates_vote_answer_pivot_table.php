<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesVoteAnswerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_answer_pivot_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solution_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('vote');
            $table->timestamps();

            // $table->primary(['issue_id', 'user_id']);
            // $table->foreign('issue_id')->references('id')->on('issues');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_answer_pivot_table');
    }
}
