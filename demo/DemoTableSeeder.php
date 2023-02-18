<?php 

use Illuminate\Database\Seeder;
use App\Page;

class DemoTableSeeder extends Seeder {
    
    protected $table = 'demos';
    protected $model = '\App\Demo';
    
    protected $seeds = [
        array( 'Demo 1', 'Test body 1.' ),
        array( 'Demo 2', 'Test body 2.' ),
        array( 'Demo 3', 'Test body 3.' ),
        array( 'Demo 4', 'Test body 4.' ),
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
