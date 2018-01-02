<?php

namespace App\Http\Controllers;

use App\Land;
use App\Building;
use App\BuildingLand;

class LandController extends Controller
{
    public function show($id) {
        $land = Land::find($id);
        $buildingOpts = Building::all();
        $buildingOptData = [];

        foreach($buildingOpts as $buildingOpt) {
            $buildingOptData[$buildingOpt->id] = $land->canBuild(new BuildingLand([
                                                    'building_id' => $buildingOpt->id, 
                                                    'level' => 1
                                                ]));
        }

        return view('land', 
            [
                'land' => $land, 
                'buildingOpts' => $buildingOpts,
                'buildingOptData' => $buildingOptData,
            ]);
    }
}
