<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProcedureProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_procedure_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('certificate_prints')->unsigned()->default(0);
            $table->timestamp('completed')->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('procedure_id')->unsigned();
            $table->foreign('procedure_id')->references('id')->on('procedures');
            $table->integer('user_procedure_status_id')->unsigned();
            $table->foreign('user_procedure_status_id')->references('id')->on('user_procedure_statuses');

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
        Schema::drop('user_procedure_progresses');
    }
}
