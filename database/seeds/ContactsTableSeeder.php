<?php

use Illuminate\Database\Seeder;
use App\Page;

class ContactsTableSeeder extends Seeder {

    protected $table = 'contacts';
    protected $model = '\App\Contact';

    protected $seeds = [
        array( 'Contact 1', 'Test body 1.' ),
        array( 'Contact 2', 'Test body 2.' ),
        array( 'Contact 3', 'Test body 3.' ),
        array( 'Contact 4', 'Test body 4.' ),
    ];

    public function run()
    {
        DB::table( $this->table )->delete();
        $model = $this->model;
        foreach ( $this->seeds AS $seed ) {
            $model::create([
                'title' => $seed[0],
                'body' => $seed[1],
            ]);
        }
    }
}
