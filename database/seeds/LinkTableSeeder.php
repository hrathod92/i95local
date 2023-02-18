<?php 

use Illuminate\Database\Seeder;
use App\Page;

class LinkTableSeeder extends Seeder {
    
    protected $table = 'links';
    protected $model = '\App\Link';
    
    protected $seeds = [
        array( 'Link 1', 'Test body 1.' ),
        array( 'Link 2', 'Test body 2.' ),
        array( 'Link 3', 'Test body 3.' ),
        array( 'Link 4', 'Test body 4.' ),
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
