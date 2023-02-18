<?php 

use Illuminate\Database\Seeder;
use App\Page;

class PaymentTableSeeder extends Seeder {
    
    protected $table = 'payments';
    protected $model = '\App\Payment';
    
    protected $seeds = [
        array( 'Payment 1', 'Test body 1.' ),
        array( 'Payment 2', 'Test body 2.' ),
        array( 'Payment 3', 'Test body 3.' ),
        array( 'Payment 4', 'Test body 4.' ),
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
