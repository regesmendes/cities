<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Land;
use App\Resource;
use App\BuildingLand;
use App\BuildingResource;
use App\LandUser;
use App\LandResource;

class CityController extends Controller
{
    public function create(Request $request) {
        $vars = $request->all();

        Auth::user()->cities()->save(new LandUser([
            'land_id' => $vars['land'],
            'name' => $vars['name']
        ]));
        foreach (Resource::all() as $resource) {
            $resources[$resource->id] = new LandResource([
                'resource_id' => $resource->id,
                'quantity' => config('app.config.INITIAL_RESOURCE_VALUE')
            ]);
        }
        $land = Land::find($vars['land']);
        $land->resources()->saveMany($resources);

        return redirect("/land/" . $vars['land']);
    }
    
    public function newBuilding(Request $request) {
        $vars = $request->all();
        $land = Land::find($vars['land']);

        foreach(BuildingResource::costs($vars['building'], 1)->get() as $resource) {
            $toUse = $resource->toLandResource();
            if (!$land->hasEnough($toUse)) {
                return redirect("/land/" . $vars['land'])->with(['alert-danger' => 'Not enough resources.']);
            } else {
                $land->use($toUse);
            }
        }
        $land->places()->save(new BuildingLand(['building_id' => $vars['building'],'level' => 1]));

        return redirect("/land/" . $vars['land'])->with(['alert-success' => 'Building built.']);
    }

    public function demolishBuilding(Request $request) {
        $vars = $request->all();

        $demolishing = BuildingLand::find($vars['building_land']);
        $refound = BuildingResource::costs($demolishing->building_id, $demolishing->level);

        foreach($refound->get() as $rss) {
            $toEarn = $rss->toLandResource();
            $toEarn->quantity = $toEarn->quantity * config('app.config.DEMOLISH_REFOUND_RATE');
            
            $demolishing->land->earn($toEarn);
        }

        BuildingLand::destroy($vars['building_land']);
        return redirect("/land/" . $vars['land']);
    }
}
