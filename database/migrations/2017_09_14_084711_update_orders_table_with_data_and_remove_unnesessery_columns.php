<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTableWithDataAndRemoveUnnesesseryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table){
            $table->dropColumn(['trial_ends_at', 'ends_at', 'contract_ends_at' ]);
            $table->json('data');
            $table->integer('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table){

            Schema::table('orders', function($table){
                $table->timestamp('trial_ends_at')->nullable();
                $table->timestamp('ends_at')->nullable();
                $table->timestamp('contract_ends_at')->nullable();
                $table->dropColumn(['data', 'company_id']);
            });

        });
    }
}
