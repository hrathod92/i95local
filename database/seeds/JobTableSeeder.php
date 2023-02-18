<?php 

use Illuminate\Database\Seeder;
use App\Page;

class JobTableSeeder extends Seeder {
    
    protected $table = 'jobs';
    protected $model = '\App\Job';
    
    protected $seeds = [
        array( 'Job 1', 'Test body 1.' ),
        array( 'Job 2', 'Test body 2.' ),
        array( 'Job 3', 'Test body 3.' ),
        array( 'Job 4', 'Test body 4.' ),
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
