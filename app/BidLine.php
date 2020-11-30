<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Storage;


class BidLine extends Model
{

    protected $guarded = [];

    public function bid()
    {
        return $this->belongsTo('App\Bid');
    }

    public function availability()
    {
        return $this->belongsTo('App\PartAvailability', 'part_availability_id');
    }

    public static function accept($validatedData)
    {
        $bidLine = BidLine::findOrFail(decrypt($validatedData['bid_line']));

        abort_unless(auth()->user()->can('acceptRejectLines', $bidLine->bid), 403);

        $bidLine->rejected_on = null;
        $bidLine->save();

        return $bidLine;
    }

    public static function reject($validatedData)
    {
        $bidLine = BidLine::findOrFail(decrypt($validatedData['bid_line']));

        abort_unless(auth()->user()->can('acceptRejectLines', $bidLine->bid), 403);

        $bidLine->rejected_on = now();
        $bidLine->save();

        return $bidLine;
    }

    public function storeImage($image)
    {
        // Set the directory to be uploaded to
        $directory = 'public/bid-lines';

        // Store the file
        $path = $image->store($directory);

        // Resize & encode image
        $image = Image::make(Storage::get($path))->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode();

        // Replace the file with the resized and encoded version
        Storage::put($path, $image);

        // Remove the directory from the path
        return str_replace($directory . "/", '', $path);
    }

    public function isRejected()
    {
        return isset($this->rejected_on);
    }

    public function isAccepted()
    {
        return !isset($this->rejected_on);
    }
}
