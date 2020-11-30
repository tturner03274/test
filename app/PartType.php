<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartType extends Model
{

    protected $guarded = [];

    public function partsRequests()
    {
        return $this->belongsToMany('App\PartsRequest');
    }
}
