@extends('_layouts.app')

@section('content')

    @includeWhen(request()->has('success'), '_partials.flash_message', ['message' => 'Your bid has been successfully posted. You will be notified when the buyer has made a decision.'])
    
    {{-- Flash messages --}}
    @includeWhen(session()->has('message'), '_partials.flash_message', ['message' => session()->get('message')])
    

    <p class="mb-4"><a class="text-brand-blue underline p-2" href="/parts-requests/{{ $bid->partsRequest->id }}">< Back to the Parts Request</a></p>
    {{-- Show the details of the associated part request --}}
    @include('bids._show.parts_request')

    {{-- Show the bid lines from this bid --}}
    @include('bids._show.bid_lines')

    {{-- If there is an accepted bid for the parent parts request --}}
    @if ( null !== $bid->partsRequest->acceptedBid() && !$bid->isRejected() )
        @include('bids._show.confirm')
    @endif

@endsection