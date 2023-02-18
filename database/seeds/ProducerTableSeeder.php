<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ProducerTableSeeder extends Seeder {
    
    protected $table = 'producers';
    protected $model = '\App\Producer';
    
    protected $seeds = [
        array( 'Producer 1', 'Test body 1.' ),
        array( 'Producer 2', 'Test body 2.' ),
        array( 'Producer 3', 'Test body 3.' ),
        array( 'Producer 4', 'Test body 4.' ),
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
