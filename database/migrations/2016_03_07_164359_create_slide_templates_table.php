<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('title_transition')->unsigned();
            $table->foreign('title_transition')->references('id')->on('transitions');
            $table->smallInteger('title_delay')->default(500);
            $table->smallInteger('title_duration')->default(500);

            $table->integer('body_transition')->unsigned();
            $table->foreign('body_transition')->references('id')->on('transitions');
            $table->smallInteger('body_delay')->default(500);
            $table->smallInteger('body_duration')->default(500);

            $table->integer('list_transition')->unsigned();
            $table->foreign('list_transition')->references('id')->on('transitions');
            $table->smallInteger('list_delay')->default(500);
            $table->smallInteger('list_duration')->default(500);
            $table->smallInteger('list_interval')->default(500);

            $table->integer('image_transition')->unsigned();
            $table->foreign('image_transition')->references('id')->on('transitions');
            $table->smallInteger('image_delay')->default(500);
            $table->smallInteger('image_duration')->default(500);

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
        Schema::drop('slide_templates');
    }
}
