<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ClickTableSeeder extends Seeder {
    
    protected $table = 'clicks';
    protected $model = '\App\Click';
    
    protected $seeds = [
        array( 'Click 1', 'Test body 1.' ),
        array( 'Click 2', 'Test body 2.' ),
        array( 'Click 3', 'Test body 3.' ),
        array( 'Click 4', 'Test body 4.' ),
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
