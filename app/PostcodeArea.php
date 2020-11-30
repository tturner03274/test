<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostcodeArea extends Model
{

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the PartsRequest for the Bid.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
