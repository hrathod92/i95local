<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->integer('gender_id')->unsigned()->default(3);
            $table->foreign('gender_id')->references('id')->on('genders');

            $table->integer('age_range_id')->unsigned()->default(1);
            $table->foreign('age_range_id')->references('id')->on('age_ranges');

            $table->integer('country_id')->unsigned()->default(1);
            $table->foreign('country_id')->references('id')->on('countries');

            $table->integer('state_id')->unsigned()->default(23);
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn( array('gender_id', 'age_range_id', 'country_id', 'state_id') );
        });
    }
}
