<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PartsRequest;
use App\Http\Requests\StorePartsRequest;

class PartsRequestController extends Controller
{

    public function index(Request $request)
    {
        // TODO do I really need the user role handle?
        $userRoleHandles = auth()->user()->roleHandles();

        // Use scopeOfUserRole from model to filter results
        $partsRequests = PartsRequest::with(['bids'])->ofUserRole(auth()->user())->get();

        return view('parts_requests.index', compact('partsRequests', 'userRoleHandles'));
    }

    public function create()
    {
        abort_unless(auth()->user()->can('create-parts-request'), 403);

        return view('parts_requests.create');
    }

    public function show(PartsRequest $partsRequest)
    {
        abort_unless(auth()->user()->can('view', $partsRequest), 403);

        return view('parts_requests.show', compact('partsRequest'));
    }

    public function store(StorePartsRequest $request)
    {
        // Validate request using Requests/StorePartsRequest
        $validatedData = $request->validated();

        // Create the parts request
        $partsRequest = PartsRequest::store($validatedData);

        // Redirect success
        return redirect('/parts-requests')->with('message', 'Your parts request has been created. Eligible suppliers will be notified via email.');
    }
}
