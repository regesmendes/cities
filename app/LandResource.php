<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandResource extends Model
{
    protected $fillable = [
        'id',
        'land_id',
        'resource_id',
        'quantity'
    ];
    
    protected $table = "land_resource";
    
    public function land() {
        return $this->belongsTo(Land::class);
    }

    public function resource() {
        return $this->belongsTo(Resource::class);
    }
}
