<?php 

use Illuminate\Database\Seeder;
use App\Page;

class faqTableSeeder extends Seeder {
    
    protected $table = 'Faqs';
    protected $model = '\App\faq';
    
    protected $seeds = [
        array( 'faq 1', 'Test body 1.' ),
        array( 'faq 2', 'Test body 2.' ),
        array( 'faq 3', 'Test body 3.' ),
        array( 'faq 4', 'Test body 4.' ),
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
