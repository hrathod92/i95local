<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ReleaseTableSeeder extends Seeder {
    
    protected $table = 'releases';
    protected $model = '\App\Release';
    
    protected $seeds = [
        array( 'Release 1', 'Test body 1.' ),
        array( 'Release 2', 'Test body 2.' ),
        array( 'Release 3', 'Test body 3.' ),
        array( 'Release 4', 'Test body 4.' ),
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
