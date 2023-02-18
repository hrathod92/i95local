<?php

use Illuminate\Database\Seeder;

class UserProcedureStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_procedure_statuses')->insert([
            ['status' => 'Not Started'],
            ['status' => 'Started'],
            ['status' => 'Complete']
        ]);
    }
}
