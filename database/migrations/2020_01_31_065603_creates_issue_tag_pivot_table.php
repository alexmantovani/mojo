<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesIssueTagPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('issue_id');
            $table->unsignedBigInteger('tag_id');

            // $table->unique('issue_id', 'tag_id');
            //
            // $table->foreign('issue_id')->references('id')->on('issue')->onDelete('cascade');
            // $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');

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
        Schema::dropIfExists('issue_tag');
    }
}
