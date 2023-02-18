<?php 

use Illuminate\Database\Seeder;
use App\Page;

class AvailabilityTableSeeder extends Seeder {
    
    protected $table = 'availabilitys';
    protected $model = '\App\Availability';
    
    protected $seeds = [
        array( 'Availability 1', 'Test body 1.' ),
        array( 'Availability 2', 'Test body 2.' ),
        array( 'Availability 3', 'Test body 3.' ),
        array( 'Availability 4', 'Test body 4.' ),
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
