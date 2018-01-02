<?php

use Illuminate\Database\Seeder;
use App\Realm;
use App\Land;

class RealmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realm = factory(Realm::class)->create();
            
        for($x = 0; $x < 50; $x++) {
            for($y = 0; $y < 50; $y++) {
                $realm->lands()->save(factory(Land::class)->make(['x' => $x, 'y' => $y]));
            }
        }
        
    }
}
