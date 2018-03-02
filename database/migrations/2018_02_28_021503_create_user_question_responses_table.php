<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->string('session')->nullable();
            $table->integer('question_id', false, true);
            $table->integer('answer_id', false, true);
            $table->timestamps();

            $table->foreign('user_id', 'u_fk')
                ->references('id')
                ->on('users');

            $table->foreign('question_id', 'qu_fk')
                ->references('id')
                ->on('questions');

            $table->foreign('answer_id', 'a_fk')
                ->references('id')
                ->on('question_answers');

            $table->index('session', 'sesh_i');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_responses');
    }
}
