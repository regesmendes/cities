<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];
    
    protected $table = 'realm';

    public function lands() {
        return $this->hasMany(Land::class);
    }

    public function line($x) {
        return $this->hasMany(Land::class)->where('x', '=', $x);
    }
}
