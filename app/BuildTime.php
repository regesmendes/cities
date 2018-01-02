<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildTime extends Model
{
    protected $fillable = [
        'id',
        'building_id',
        'level',
        'build_time'
    ];
    
    protected $table = "build_time";
    
    public function building() {
        return $this->belongsTo(Building::class);
    }
}
