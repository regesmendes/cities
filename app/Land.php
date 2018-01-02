<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Land extends Model
{
    protected $fillable = [
        'id',
        'realm_id',
        'x',
        'y'
    ];

    protected $table = 'land';

    public function realm() {
        return $this->belongsTo(Realm::class);
    }

    public function city() {
        return $this->hasOne(LandUser::class);
    }

    public function places() {
        return $this->hasMany(BuildingLand::class);
    }

    public function resources() {
        return $this->hasMany(LandResource::class);
    }
    
    public function isConstructing() {
        $canBuild = false;
        foreach($this->places()->get() as $place) {
            $canBuild = $canBuild && !$place->isUnderConstruction();
            if (!$canBuild) break;
        }
        return $canBuild;
    }

    public function canBuild(BuildingLand $buildingLand) {
        $canBuild = $this->city 
                    && $this->city->isOwnedByLoggedUser()  // comment this line for tinker tests  
                    && !$this->isConstructing();
        $details = new Collection();

        if ($canBuild) {
            foreach($buildingLand->building->costs($buildingLand->level)->get() as $rss) {
                $hasEnough = $this->hasEnough($rss->toLandResource());
                $details->push([
                        'name' => $rss->resource->name,
                        'quantity' => $rss->base,
                        'hasEnough' => $hasEnough
                    ]);
                $canBuild = $canBuild && $hasEnough;
            }
        }

        return new Collection([
            'canBuild' => $canBuild,
            'resources' => $details
        ]);
    }
    
    public function production() {
        $res = new Collection();
        foreach($this->places()->get() as $place) {
            foreach($place->production()->get() as $product) {
                $res->push($product);
            }
        }
        return $res;
    }

    public function getStock($resourceId) {
        return $this->resources()
            ->where('resource_id', '=', $resourceId)
            ->first();
    }

    public function hasEnough(LandResource $resource) {
        $stock = $this->updateStock(new LandResource([
            'land_id' => $this->id,
            'resource_id' => $resource->resource_id,
            'quantity' => 0
        ]));
        return ($stock->quantity > $resource->quantity);
    }

    private function updateStock(LandResource $toEarn) {
        $refDate = (new \Datetime())->format('Y-m-d H:i:s');
        $productionCollected = new Collection(); 
        foreach($this->places as $place) {
            foreach($place->collect($refDate) as $collected) {
                $productionCollected->push($collected);
            }
        }
        foreach($productionCollected->groupBy('resource_id') as $producedResource) {
            $stock = $this->getStock($producedResource->first()->resource_id);
            if ($stock) {
                $stock->quantity += $producedResource->sum('quantity');
                $stock->save();
            }
        }
        
        $stock = $this->getStock($toEarn->resource_id);
        if ($stock) {
            if ($toEarn->quantity) {
                $stock->quantity += $toEarn->quantity;
                $stock->save();
            }
        } else {
            $stock = new LandResource([
                'resource_id' => $toEarn->resource_id,
                'quantity' => 0,
            ]);
        }
        
        return $stock;
    }

    public function use(LandResource $resource) {
        if ($resource->quantity > 0) {
            $resource->quantity = $resource->quantity * -1;
        }
        return $this->updateStock($resource);
    }

    public function earn(LandResource $resource) {
        if ($resource->quantity < 0) {
            $resource->quantity = $resource->quantity * -1;
        }
        return $this->updateStock($resource);
    }
}
