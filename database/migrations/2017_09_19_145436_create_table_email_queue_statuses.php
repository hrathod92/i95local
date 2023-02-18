<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTableEmailQueueStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("email_queue_statuses", function($table){
            $table->increments('id');
            $table->string('title');
        });

        DB::table('email_queue_statuses')->insert(
            [
                [
                    "title" => "Not yet included"
                ],
                [
                    "title" => "Included"
                ],
                [
                    "title" => "Should never be included"
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("email_queue_statuses");
    }
}
