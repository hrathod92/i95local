<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {
    public function run()
    {
        DB::table( 'users' )->delete();
        User::create([
            'email' => 'admin@test.com',
            'password' => Hash::make("cg4dmin!"),
            'role' => 'admin'
        ]);
        User::create([
            'email' => 'user@test.com',
            'password' => Hash::make("cg4dmin!"),
            'role' => 'user'
        ]);
    }
}
