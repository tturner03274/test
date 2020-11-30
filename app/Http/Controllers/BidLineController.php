<?php

namespace App\Http\Controllers;

use App\BidLine;
use Illuminate\Http\Request;

class BidLineController extends Controller
{
    public function destroy(Request $request)
    {

        // Validate
        $validatedData = $request->validate([
            'bid_line' => ['required', 'min:50', 'string'],
        ]);

        // Reject the line
        $bidLine = BidLine::reject($validatedData);

        // Return ajax data
        return [
            'total_retail' => $bidLine->bid->totalRetailPrice(),
            'total_trade' => $bidLine->bid->totalTradePrice(),
        ];
    }

    public function store(Request $request)
    {

        // Validate
        $validatedData = $request->validate([
            'bid_line' => ['required', 'min:50', 'string'],
        ]);

        // Accept the line
        $bidLine = BidLine::accept($validatedData);

        // Return ajax data
        return [
            'total_retail' => $bidLine->bid->totalRetailPrice(),
            'total_trade' => $bidLine->bid->totalTradePrice(),
        ];
    }
}
