<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BuildingLand extends Model
{
    protected $fillable = [
        'id',
        'building_id',
        'land_id',
        'level'
    ];

    protected $table = 'building_land'; // aka: place

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function land() {
        return $this->belongsTo(Land::class);
    }

    public function production() {
        return BuildingResource::production(
            $this->building_id, 
            $this->isUnderConstruction() ? 0 : $this->level
        );
    }

    public function collect($collectDate) {
        $resource = new Collection();
        if (!$this->isUnderConstruction()) {
            foreach($this->production()->get() as $product) {
                $stock = $this->land->getStock($product->resource_id);
                $stockDate = new \DateTime($stock->updated_at);
                $collectDateSecs = strtotime($collectDate);
                $refDateSecs = ($this->begunProductionAt() < $stockDate) 
                            ? strtotime($stockDate->format('Y-m-d H:i:s')) 
                            : strtotime($this->begunProductionAt()->format('Y-m-d H:i:s'));
                $quantity = 0;
                if ($collectDateSecs > $refDateSecs) {
                    $quantity = (($collectDateSecs - $refDateSecs) / 3600) * $product->base;
                }
                $resource->push(new LandResource([
                    'resource_id' => $product->resource_id,
                    'land_id' => $this->land_id,
                    'quantity' => $quantity  
                ]));
            }
        }
        return $resource;
    }

    public function buildTime() {
        return $this->building
                    ->buildTimes()
                    ->where('level','=', $this->level);
    }

    public function isUnderConstruction() {
        $termDate = $this->begunProductionAt();
        $now = new \DateTime();
        return ($now < $termDate);
    }

    public function begunProductionAt() {
        $buildTime = $this->buildTime()->first();

        $startDate = new \DateTime($this->updated_at);
        $interval = explode(':', $buildTime->build_time);
        return $startDate->add(new \DateInterval('PT' . $interval[0] . 'H' . $interval[1] . 'M' . $interval[2] . 'S'));
    }
}
