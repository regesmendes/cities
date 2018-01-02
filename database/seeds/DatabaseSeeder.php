<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RealmTableSeeder::class);
        $this->call(ResourceTableSeeder::class);
        $this->call(BuildingTableSeeder::class);
        $this->call(BuildTimeTableSeeder::class);
    }
}
