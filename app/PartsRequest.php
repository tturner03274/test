<?php

namespace App;

use App\Mail\PartsRequestCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PartsRequest extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public function bids()
    {
        return $this->hasMany('\App\Bid');
    }

    public function owner()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function images()
    {
        return $this->hasMany('\App\PartsRequestImage');
    }

    public function partTypes()
    {
        return $this->belongsToMany('App\PartType');
    }

    public function scopeOfUserRole($query, User $user)
    {
        // Buyers own requests
        if ($user->isBuyer()) return $query->where('user_id', $user->id);

        // Suppliers: Get all the parts requests where the (shortened) delivery postcode is in the users postcode areas
        if ($user->isSupplier()) {

            // User's eligible postcode areas
            $postcodeAreasArray = $user->postcodeAreasArray();

            return $query->where(function ($query) use ($postcodeAreasArray) {
                foreach ($postcodeAreasArray as $shortPostcode) {
                    $query->orWhere('delivery_postcode', 'like', $shortPostcode . '%');
                }
            });
        }
    }

    public static function store($validatedData)
    {
        // Pull relationship data out the array
        $partTypes = array_pull($validatedData, 'part_types');
        $partsImages = array_pull($validatedData, 'parts_images');

        // Add the user as the owner
        $validatedData['user_id'] = auth()->user()->id;

        // Create new Part Request
        $partsRequest = PartsRequest::create($validatedData);

        // Part images
        if ($partsImages) {
            foreach ($partsImages as $filename) {

                // Move the temp file to the proper location
                $temp_path = '/public/parts-images/temp/' . $filename;
                $target_path = '/public/parts-images/' . $filename;
                Storage::move($temp_path, $target_path);

                // Attach file to parts request and persist to DB
                $partsRequest->images()->create([
                    'filename' => $filename
                ]);
            }
        }

        /* Part Types
        * The id is sent in the request if the type is already in the predefined list
        * If not the value is the string of the new type
        */

        foreach ($partTypes as $partTypeValue) {

            // Does the value start with a double underscore? then its a new custom type
            if (substr($partTypeValue, 0, 2) === "__") {

                // Create new non-predefined part type
                $partType = new \App\PartType;
                $partType->name = trim($partTypeValue, "__");
                $partType->predefined = false;
                $partType->save();

                $partsRequest->partTypes()->attach($partType->id);
            }

            if (is_numeric($partTypeValue)) {
                // Check its an integer then attach
                $partsRequest->partTypes()->attach($partTypeValue);
            }
        }

        // Email eligible suppliers about the new parts request
        $eligibleSuppliers = User::suppliers()->canDeliver($partsRequest)->get();

        foreach ($eligibleSuppliers as $supplier) {
            Mail::to($supplier->email)
                ->queue(new PartsRequestCreated($partsRequest));
        }

        return $partsRequest;
    }

    public function getEligibleSuppliers()
    {
        return User::canDeliver($this);
    }

    public function formattedCreatedAt()
    {
        return Carbon::parse($this->created_at)->format('D j M Y G:i');
    }

    public function getMinutesLeft()
    {
        return $this->deadline - $this->created_at->diffInMinutes();
    }

    public function humanDeadline()
    {
        $diffForHumans = $this->created_at->addMinutes($this->deadline)->diffForHumans(['short' => true], true);

        if (!$this->isExpired()) return  $diffForHumans;

        return $diffForHumans . ' ago';
    }

    public function isExpired()
    {
        return $this->getMinutesLeft() <= 0;
    }

    public function acceptedBid()
    {
        return $this->bids()->whereNotNull('accepted_at')->first();
    }

    public function confirmedBid()
    {
        return $this->bids()->whereNotNull('accepted_at')->whereNotNull('delivery_time')->first();
    }

    public function timeUntilDelivery()
    {
        if (!$this->confirmedBid()) return false;

        return Carbon::now()->diffInSeconds($this->confirmedBid()->delivery_time, false);
    }

    public function isCompleted()
    {
        // we have a confirmed bid
        if (!$this->confirmedBid()) return false;

        if ($this->timeUntilDelivery() < 0) return true;
    }

    public function getStatusAttribute()
    {
        // Keep last stage first
        if ($this->isCompleted()) return 'completed';
        if ($this->timeUntilDelivery() > 0) return 'pending_delivery';
        if ($this->confirmedBid()) return 'bid_confirmed';
        if ($this->acceptedBid()) return 'bid_accepted';
        if ($this->isExpired()) return 'expired';
    }
}
