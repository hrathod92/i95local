<?php 

use Illuminate\Database\Seeder;
use App\Page;

class VideoTableSeeder extends Seeder {
    
    protected $table = 'videos';
    protected $model = '\App\Video';
    
    protected $seeds = [
        array( 'Video 1', 'Test body 1.' ),
        array( 'Video 2', 'Test body 2.' ),
        array( 'Video 3', 'Test body 3.' ),
        array( 'Video 4', 'Test body 4.' ),
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
