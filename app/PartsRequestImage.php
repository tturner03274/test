<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartsRequestImage extends Model
{

    protected $guarded = [];

    public function partsRequest()
    {
        return $this->belongsTo('App\PartsRequest');
    }
}
