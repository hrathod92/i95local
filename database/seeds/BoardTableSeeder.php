<?php 

use Illuminate\Database\Seeder;
use App\Page;

class BoardTableSeeder extends Seeder {
    
    protected $table = 'boards';
    protected $model = '\App\Board';
    
    protected $seeds = [
        array( 'Board 1', 'Test body 1.' ),
        array( 'Board 2', 'Test body 2.' ),
        array( 'Board 3', 'Test body 3.' ),
        array( 'Board 4', 'Test body 4.' ),
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
