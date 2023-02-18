<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        // $this->call(ContactsTableSeeder::class);
        $this->call(ContentsTableSeeder::class);
        $this->call(GrantsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        Model::reguard();
    }
}
