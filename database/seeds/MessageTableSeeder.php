<?php 

use Illuminate\Database\Seeder;
use App\Page;

class MessageTableSeeder extends Seeder {
    
    protected $table = 'messages';
    protected $model = '\App\Message';
    
    protected $seeds = [
        array( 'Message 1', 'Test body 1.' ),
        array( 'Message 2', 'Test body 2.' ),
        array( 'Message 3', 'Test body 3.' ),
        array( 'Message 4', 'Test body 4.' ),
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
