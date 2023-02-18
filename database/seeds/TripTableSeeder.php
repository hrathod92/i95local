<?php 

use Illuminate\Database\Seeder;
use App\Page;

class TripTableSeeder extends Seeder {
    
    protected $table = 'trips';
    protected $model = '\App\Trip';
    
    protected $seeds = [
        array( 'Trip 1', 'Test body 1.' ),
        array( 'Trip 2', 'Test body 2.' ),
        array( 'Trip 3', 'Test body 3.' ),
        array( 'Trip 4', 'Test body 4.' ),
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
