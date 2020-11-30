<?php

namespace App\Http\Controllers;

use App\Bid;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBid;
use App\PartsRequest;

class BidController extends Controller
{

    public function index(PartsRequest $partsRequest)
    {
        return redirect('parts-requests/' . $partsRequest->id);
    }

    public function show(Bid $bid)
    {
        abort_unless(auth()->user()->can('view', $bid), 403);
        $bid = Bid::with('partsRequest', 'partsRequest.owner')->findOrFail($bid->id);
        return view('bids.show', compact('bid'));
    }

    public function store(StoreBid $request, PartsRequest $partsRequest)
    {
        // Validation handled by Requests/StoreBid
        $validatedData = $request->validated();

        // Store the validated data and create the models
        $bid = Bid::store($validatedData, $partsRequest);

        // Redirect and messages handled by JS (to prevent losing data on failed submission)
        return $bid;
    }

    public function accept(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            'bid_id' => ['required', 'min:50', 'string'],
        ]);

        // Accept the bid
        Bid::accept($validatedData);

        // Redirect 
        return redirect()->back()->with('message', 'You have accepted the bid, the supplier will be notified and asked to confirm a delivery time.');
    }

    public function confirm(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            'bid_id' => ['required', 'min:50', 'string'],
            'delivery_time' => 'required|date|after_or_equal:today',
            'delivery_notes' => 'nullable|string',
        ]);

        // Accept the bid
        Bid::confirm($validatedData);

        // Redirect 
        return redirect()->back()->with('message', 'Thank you for confirming delivery, the buyer has been notified via email.');
    }
}
