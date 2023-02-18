<?php 

use Illuminate\Database\Seeder;
use App\Page;

class OfficerTableSeeder extends Seeder {
    
    protected $table = 'officers';
    protected $model = '\App\Officer';
    
    protected $seeds = [
        array( 'Officer 1', 'Test body 1.' ),
        array( 'Officer 2', 'Test body 2.' ),
        array( 'Officer 3', 'Test body 3.' ),
        array( 'Officer 4', 'Test body 4.' ),
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
