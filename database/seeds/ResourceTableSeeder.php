<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ResourceTableSeeder extends Seeder {
    
    protected $table = 'resources';
    protected $model = '\App\Resource';
    
    protected $seeds = [
        array( 'Resource 1', 'Test body 1.' ),
        array( 'Resource 2', 'Test body 2.' ),
        array( 'Resource 3', 'Test body 3.' ),
        array( 'Resource 4', 'Test body 4.' ),
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
