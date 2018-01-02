<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    protected $table = 'resource';

    public function lands() {
        return $this->hasMany(LandResource::class);
    }

    public function resourceTable() {
        return $this->hasMany(BuildingResource::class);
    }

    public function toLandResource() {
        return new LandResource([
            'resource_id' => $this->id,
            'quantity' => 0
        ]);
    }

    public static function clayId() {
        $rss = Resource::where('name','=','clay')->first();
        return $rss->id; 
    }

    public static function woodId() {
        $rss = Resource::where('name','=','wood')->first();
        return $rss->id;
    }

    public static function stoneId() {
        $rss = Resource::where('name','=','stone')->first();
        return $rss->id;
    }

    public static function foodId() {
        $rss = Resource::where('name','=','food')->first();
        return $rss->id;
    }
}
