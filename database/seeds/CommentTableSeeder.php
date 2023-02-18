<?php 

use Illuminate\Database\Seeder;
use App\Page;

class CommentTableSeeder extends Seeder {
    
    protected $table = 'comments';
    protected $model = '\App\Comment';
    
    protected $seeds = [
        array( 'Comment 1', 'Test body 1.' ),
        array( 'Comment 2', 'Test body 2.' ),
        array( 'Comment 3', 'Test body 3.' ),
        array( 'Comment 4', 'Test body 4.' ),
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
