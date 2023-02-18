<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStripeAndUserDetailsToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table){
            $table->integer('user_id')->nullable();
            $table->string('stripe_id');
            $table->string('product_id');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->string('status');
            $table->text('notes');
            $table->timestamp('contract_ends_at')->nullable();
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
            $table->dropColumn(['user_id', 'stripe_id', 'stripe_plan',
                                'trial_ends_at', 'ends_at', 'product_id',
                                'status', 'notes', 'contract_ends_at']
            );
        });
    }
}
