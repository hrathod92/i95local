<?php 

use Illuminate\Database\Seeder;
use App\Page;

class TrackTableSeeder extends Seeder {
    
    protected $table = 'tracks';
    protected $model = '\App\Track';
    
    protected $seeds = [
        array( 'Track 1', 'Test body 1.' ),
        array( 'Track 2', 'Test body 2.' ),
        array( 'Track 3', 'Test body 3.' ),
        array( 'Track 4', 'Test body 4.' ),
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
