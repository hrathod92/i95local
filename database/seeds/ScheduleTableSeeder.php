<?php 

use Illuminate\Database\Seeder;
use App\Page;

class ScheduleTableSeeder extends Seeder {
    
    protected $table = 'schedules';
    protected $model = '\App\Schedule';
    
    protected $seeds = [
        array( 'Schedule 1', 'Test body 1.' ),
        array( 'Schedule 2', 'Test body 2.' ),
        array( 'Schedule 3', 'Test body 3.' ),
        array( 'Schedule 4', 'Test body 4.' ),
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
