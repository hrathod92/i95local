<?php 

use Illuminate\Database\Seeder;
use App\Page;

class NewsletterTableSeeder extends Seeder {
    
    protected $table = 'newsletters';
    protected $model = '\App\Newsletter';
    
    protected $seeds = [
        array( 'Newsletter 1', 'Test body 1.' ),
        array( 'Newsletter 2', 'Test body 2.' ),
        array( 'Newsletter 3', 'Test body 3.' ),
        array( 'Newsletter 4', 'Test body 4.' ),
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
