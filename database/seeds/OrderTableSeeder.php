<?php 

use Illuminate\Database\Seeder;
use App\Page;

class OrderTableSeeder extends Seeder {
    
    protected $table = 'orders';
    protected $model = '\App\Order';
    
    protected $seeds = [
        array( 'Order 1', 'Test body 1.' ),
        array( 'Order 2', 'Test body 2.' ),
        array( 'Order 3', 'Test body 3.' ),
        array( 'Order 4', 'Test body 4.' ),
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
