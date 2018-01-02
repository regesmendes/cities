<?php

use Illuminate\Database\Seeder;
use App\Building;
use App\BuildTime;

class BuildTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Building::all() as $building) {
            $building->buildTimes()->save(new BuildTime([
                'level' => 1,
                'build_time' => '00:00:02',
            ]));
        }
    }
}
