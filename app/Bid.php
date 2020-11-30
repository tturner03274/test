<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BidLine;
use App\Mail\BidAccepted;
use App\Mail\BidConfirmed;
use App\Mail\BidRejected;
use App\PartsRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Bid extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['delivery_time'];

    public function partsRequest()
    {
        return $this->belongsTo('App\PartsRequest');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function lines()
    {
        return $this->hasMany('App\BidLine');
    }

    public static function store($validatedData, PartsRequest $partsRequest)
    {
        // Create new Bid
        $bid = Bid::create([
            'user_id' => auth()->user()->id,
            'parts_request_id' => $partsRequest->id,
        ]);

        // Process Bid lines
        foreach ($validatedData['bid_lines'] as $lineData) {
            // Initiate a new model
            $bidLine = new BidLine();

            // Take the image out the lineData array
            $image = array_pull($lineData, 'image');

            // Upload the image and insert it back into the array with a new key
            $lineData['image_path'] = $bidLine->storeImage($image);

            // change the key for availability
            $lineData['part_availability_id'] = $lineData['availability'];

            // delete the original avail
            unset($lineData['availability']);

            // mass assign the array to the bid line
            $bidLine->fill($lineData);

            // Save the bidline and attach to the bid
            $bid->lines()->save($bidLine);
        }

        // Email the parts request owner
        Mail::to($partsRequest->owner->email)
            ->queue(new \App\Mail\BidCreated($partsRequest));

        return $bid;
    }

    public static function accept($validatedData)
    {
        // Get bid from the encrypted id
        $bid = Bid::findOrFail(decrypt($validatedData['bid_id']));

        // Can this user accept?
        abort_unless(auth()->user()->can('accept', $bid), 403);

        // Accept the bid
        $bid->accepted_at = \Carbon\Carbon::now();
        $bid->save();

        // Email To this Bid user ( because this being accepted )
        Mail::to($bid->user->email)
            ->queue(new BidAccepted($bid));

        // Email To Rejected Suppliers
        // Get all rejected bids
        $rejectedBids = $bid->partsRequest->bids()->with('user')->whereNull('accepted_at')->get();

        // Then send email to each $rejectedBid supplier
        foreach ($rejectedBids as $rejectedBid) {
            Mail::to($rejectedBid->user->email)
                ->queue(new BidRejected($rejectedBid));
        };

        // Return
        return $bid;
    }

    public static function confirm($validatedData)
    {
        // Get bid from the encrypted id
        $bid = Bid::findOrFail(decrypt($validatedData['bid_id']));

        // Can this user confirm? Are they the supplier?
        abort_unless(auth()->user()->can('confirm', $bid), 403);

        // Update the delivery times
        $bid->delivery_time = \Carbon\Carbon::parse($validatedData['delivery_time']);
        $bid->delivery_notes = $validatedData['delivery_notes'];
        $bid->save();

        // Email to buyer - The supplier has confirmed
        Mail::to($bid->partsRequest->owner)
            ->queue(new BidConfirmed($bid));


        // Return
        return $bid;
    }

    public function acceptedLines()
    {
        return $this->lines()->whereNull('rejected_on');
    }

    public function totalTradePrice()
    {
        $total = 0;
        foreach ($this->acceptedLines as $line) {
            $total = $total + $line->trade_price;
        }
        return $total;
    }

    public function totalRetailPrice()
    {
        $total = 0;
        foreach ($this->acceptedLines as $line) {
            $total = $total + $line->retail_price;
        }
        return $total;
    }

    public function formattedDeliveryTime()
    {
        return \Carbon\Carbon::parse($this->delivery_time)->format('D j M Y H:i');
    }

    public function formattedCreatedAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('D j M Y H:i');
    }

    public function isAccepted()
    {
        if (!$this->partsRequest->acceptedBid()) return false;

        return $this->partsRequest->acceptedBid()->id == $this->id;
    }

    public function isRejected()
    {
        if (!$this->partsRequest->acceptedBid()) return false;
        return $this->partsRequest->acceptedBid()->id !== $this->id;
    }

    public function isConfirmed()
    {
        if (!$this->partsRequest->confirmedBid()) return false;
        return $this->partsRequest->confirmedBid()->id == $this->id;
    }

    public function status()
    {
        if ($this->isAccepted()) return 'accepted';
        if ($this->isRejected()) return 'rejected';
        if ($this->isConfirmed()) return 'confirmed';

        return 'pending';
    }
}
