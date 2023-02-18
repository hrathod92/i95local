<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ProfileTableSeeder extends Seeder {
    
    protected $table = 'profiles';
    protected $model = '\App\Profile';
    
    protected $seeds = [
        array( 'Profile 1', 'Test body 1.' ),
        array( 'Profile 2', 'Test body 2.' ),
        array( 'Profile 3', 'Test body 3.' ),
        array( 'Profile 4', 'Test body 4.' ),
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
