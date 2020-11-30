<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'role',
        'company_name',
        'company_registration',
        'limited_company',
        'telephone',
        'address_line_1',
        'address_line_2',
        'town_city',
        'county',
        'post_code',
        'active'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parts_requests()
    {
        return $this->hasMany('\App\PartsRequest');
    }

    public function bids()
    {
        return $this->hasMany('\App\Bid');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function postcodeAreas()
    {
        return $this->belongsToMany('\App\PostcodeArea');
    }

    public function roleHandles()
    {
        return $this->roles()->pluck('handle');
    }


    public function isBuyer()
    {
        return $this->hasRole('buyer');
    }

    public function isSupplier()
    {
        return $this->hasRole('supplier');
    }

    public function scopeAdmins($query)
    {
        return $query->whereHas('roles', function ($query2) {
            $query2->where('handle', 'admin');
        });
    }

    public function scopeSuppliers($query)
    {
        return $query->whereHas('roles', function ($query2) {
            $query2->where('handle', 'supplier');
        });
    }

    public function hasRole($roles)
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        foreach ($this->roles()->get() as $role) {
            if (in_array($role->handle, $roles)) {
                return true;
            }
        }
        return false;
    }


    public function hasBidded(PartsRequest $partsRequest)
    {
        return $partsRequest->bids()->where('user_id', $this->id)->first();
    }


    public function getBid(PartsRequest $partRequest)
    {
        return \App\Bid::where('user_id', $this->id)->where('parts_request_id', $partRequest->id)->first();
    }


    public function isPartsRequestOwner(PartsRequest $partsRequest)
    {
        return $partsRequest->user_id == auth()->user()->id;
    }

    public function isBidOwner($bid)
    {
        return $bid->where('user_id', $this->id)->first();
    }


    public function getBids($parts_request_id)
    {

        $bids = \App\Bid::where('parts_request_id', $parts_request_id)->latest()->get();

        if (is_null($bids)) return false;

        return $bids;
    }


    public function setRoleByHandle($userHandle)
    {
        $roleObject = \App\Role::where('handle', $userHandle)->firstorFail();
        if ($roleObject) {
            $this->roles()->attach($roleObject->id);
        }
    }

    public function postcodeAreasArray()
    {
        return $this->postcodeAreas->pluck('postcode')->toArray();
    }

    public function setSupplierPostcodes($postcodesCovered)
    {
        // Process user submitted comma seperated text field into array
        $postcodes = explode(",", $postcodesCovered);

        // Process each postcode
        foreach ($postcodes as $postcode) {

            // Get the ID of the existing or new postcode
            $supplierPostcode = \App\PostcodeArea::firstOrCreate(['postcode' => $postcode]);

            // Attach this user (supplier) to that postcode
            $this->postcodeAreas()->attach($supplierPostcode->id);
        }
    }

    /*     public function canDeliver(PartsRequest $partsRequest)
    {

        // Retrieve the postcode to match against the csv uploaded supplier postcodes
        $postcode = $partsRequest->delivery_postcode;

        // Check for an end section and then if present, remove it
        if (preg_match('/(\S*)\s*\d\w\w$/', $postcode, $match, PREG_OFFSET_CAPTURE)) {
            $shortPostcode = $match[1][0];
        }

        return $this->postcodeAreas()->where('postcode', $shortPostcode)->exists();
    } */

    public function scopeCanDeliver($query, PartsRequest $partsRequest)
    {

        // Retrieve the postcode to match against the csv uploaded supplier postcodes
        $postcode = $partsRequest->delivery_postcode;

        // Shorten the postcode e.g. CM21 9JX -> CM21
        if (preg_match('/(\S*)\s*\d\w\w$/', $postcode, $match, PREG_OFFSET_CAPTURE)) {
            $shortPostcode = $match[1][0];
        }

        return $query->whereHas('postcodeAreas', function ($query2) use ($shortPostcode) {
            $query2->where('postcode', 'like', $shortPostcode);
        });
    }
}
