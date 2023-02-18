<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ContributorTableSeeder extends Seeder {
    
    protected $table = 'contributors';
    protected $model = '\App\Contributor';
    
    protected $seeds = [
        array( 'Contributor 1', 'Test body 1.' ),
        array( 'Contributor 2', 'Test body 2.' ),
        array( 'Contributor 3', 'Test body 3.' ),
        array( 'Contributor 4', 'Test body 4.' ),
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
