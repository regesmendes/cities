<?php

use Illuminate\Database\Seeder;
use App\Building;
use App\Resource;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $building = factory(Building::class)->create(['name' => 'clay pit']);
        $building = Building::find(1);
        $building->resources()->attach([
            Resource::clayId()  => ['type'=>'cost','level'=>1,'base'=>4],
            Resource::stoneId() => ['type'=>'cost','level'=>1,'base'=>10],
            Resource::woodId()  => ['type'=>'cost','level'=>1,'base'=>12],
            Resource::foodId()  => ['type'=>'cost','level'=>1,'base'=>10],
        ]);
        $building->resources()->attach([
            Resource::clayId()  => ['type'=>'production','level'=>1,'base'=>20],
        ]);
        
        // $building = factory(Building::class)->create(['name' => 'quarry']);
        $building = Building::find(2);
        $building->resources()->attach([
            Resource::clayId()  => ['type'=>'cost','level'=>1,'base'=>10],
            Resource::stoneId() => ['type'=>'cost','level'=>1,'base'=>4],
            Resource::woodId()  => ['type'=>'cost','level'=>1,'base'=>10],
            Resource::foodId()  => ['type'=>'cost','level'=>1,'base'=>12],
        ]);
        $building->resources()->attach([
            Resource::stoneId() => ['type'=>'production','level'=>1,'base'=>20],
        ]);

        // $building = factory(Building::class)->create(['name' => 'sawmill']);
        $building = Building::find(3);
        $building->resources()->attach([
            Resource::clayId()  => ['type'=>'cost','level'=>1,'base'=>12],
            Resource::stoneId() => ['type'=>'cost','level'=>1,'base'=>10],
            Resource::woodId()  => ['type'=>'cost','level'=>1,'base'=>4],
            Resource::foodId()  => ['type'=>'cost','level'=>1,'base'=>10],
        ]);
        $building->resources()->attach([
            Resource::woodId()  => ['type'=>'production','level'=>1,'base'=>20],
        ]);

        // $building = factory(Building::class)->create(['name' => 'farm']);
        $building = Building::find(4);
        $building->resources()->attach([
            Resource::clayId()  => ['type'=>'cost','level'=>1,'base'=>10],
            Resource::stoneId() => ['type'=>'cost','level'=>1,'base'=>12],
            Resource::woodId()  => ['type'=>'cost','level'=>1,'base'=>10],
            Resource::foodId()  => ['type'=>'cost','level'=>1,'base'=>4],
        ]);
        $building->resources()->attach([
            Resource::foodId()  => ['type'=>'production','level'=>1,'base'=>40],
        ]);
    }
}
