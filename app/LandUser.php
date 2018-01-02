<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LandUser extends Model
{
    protected $fillable = [
        'id',
        'land_id',
        'user_id',
        'name'
    ];

    protected $table = 'land_user';

    public function land() {
        return $this->belongsTo(Land::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function isOwnedByLoggedUser() {
        return ($this->user_id == Auth::user()->id);
    }
}
