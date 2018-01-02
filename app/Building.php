<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    protected $table = 'building';

    public function places() {
        return $this->hasMany(BuildingLand::class);
    }

    public function resourceTable() {
        return $this->hasMany(BuildingResource::class);
    }

    public function buildTimes() {
        return $this->hasMany(BuildTime::class);
    }
    
    public function costs($level) {
        return BuildingResource::costs($this->id, $level);
    }
}
