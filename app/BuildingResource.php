<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingResource extends Model
{
    protected $fillable = [
        'id',
        'building_id',
        'resource_id',
        'level',
        'type',
        'base'
    ];

    protected $table = "building_resource";

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function resource() {
        return $this->belongsTo(Resource::class);
    }
    
    public function toLandResource() {
        return new LandResource([
            'resource_id' => $this->resource_id,
            'quantity' => $this->base
        ]);
    }

    private static function getRecs($building, $level, $type, $resource) {
        $query = self::where('building_id', '=', $building)
                    ->where('type', '=', $type)
                    ->where('level', '=', $level);

        if ($resource) {
            $query = $query->where('resrouce_id', '=', $resource);
        }
        return $query;
    }

    public static function costs($building, $level, $resource = 0) {
        return self::getRecs($building, $level, 'cost', $resource);
    }

    public static function production($building, $level, $resource = 0) {
        return self::getRecs($building, $level, 'production', $resource);
    }

    public static function consumption($building, $level, $resource = 0) {
        return self::getRecs($building, $level, 'consumption', $resource);
    }
}
