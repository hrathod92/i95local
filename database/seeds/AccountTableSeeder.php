<?php 

use Illuminate\Database\Seeder;
use App\Page;

class AccountTableSeeder extends Seeder {
    
    protected $table = 'accounts';
    protected $model = '\App\Account';
    
    protected $seeds = [
        array( 'Account 1', 'Test body 1.' ),
        array( 'Account 2', 'Test body 2.' ),
        array( 'Account 3', 'Test body 3.' ),
        array( 'Account 4', 'Test body 4.' ),
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
