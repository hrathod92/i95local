<?php 

use Illuminate\Database\Seeder;
use App\Page;

class LocationTableSeeder extends Seeder {
    
    protected $table = 'locations';
    protected $model = '\App\Location';
    
    protected $seeds = [
        array( 'Location 1', 'Test body 1.' ),
        array( 'Location 2', 'Test body 2.' ),
        array( 'Location 3', 'Test body 3.' ),
        array( 'Location 4', 'Test body 4.' ),
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
