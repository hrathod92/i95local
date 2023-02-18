<?php 

use Illuminate\Database\Seeder;
use App\Page;

class TicketTableSeeder extends Seeder {
    
    protected $table = 'tickets';
    protected $model = '\App\Ticket';
    
    protected $seeds = [
        array( 'Ticket 1', 'Test body 1.' ),
        array( 'Ticket 2', 'Test body 2.' ),
        array( 'Ticket 3', 'Test body 3.' ),
        array( 'Ticket 4', 'Test body 4.' ),
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
