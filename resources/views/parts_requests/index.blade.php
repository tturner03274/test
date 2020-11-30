@extends('_layouts.app')

@section('document_title', 'Parts Requests')

@section('content')

{{-- Flash messages --}}
@includeWhen(session()->has('message'), '_partials.flash_message', ['message' => session()->get('message')])

@isset($partsRequests)


    <div class="flex justify-between mb-4">
        @if ( auth()->user()->can('create-parts-request' ) )
            <a href="/parts-requests/create/" class="ml-auto pw-btn pw-btn-blue">+ Create New Parts Request</a>
        @endif
    </div>

    <table
        id="js-parts-requests"
        class="mb-8 bg-white rounded-lg shadow-md w-full table-fixed"
        data-page-length='10'
        @if( auth()->user()->isBuyer() )
            data-order='[[ 6, "asc" ], [ 5, "asc" ]]'
        @elseif( auth()->user()->isSupplier() )
            data-order='[[ 5, "asc" ]]'
        @endif
    >
        
        <thead>
            <th class="pw-th cursor-pointer w-48 rounded-tl-lg">Status</th>
            <th class="pw-th cursor-pointer w-40">Vehicle Registration</th>
            <th class="pw-th cursor-pointer">Vehicle Make</th>
            <th class="pw-th cursor-pointer">Vehicle Model</th>
            <th class="pw-th cursor-pointer w-40">Delivery Postcode</th>
            <th class="pw-th cursor-pointer w-32">Deadline</th>
            
            @if ( auth()->user()->isBuyer() )
            <th class="pw-th cursor-pointer w-32 rounded-tr-lg">Bids</th>
            @endif
            
            @if ( auth()->user()->isSupplier() )
            <th class="pw-th cursor-pointer w-48">Your Quote</th>
            @endif

        </thead>

        @forelse ($partsRequests as $partsRequest)
            <tr class="odd:bg-brand-gray-100 {{ $partsRequest->isExpired() ? 'text-brand-gray-400' : '' }}">
                
                {{-- part request status --}}
                <td class="p-3 text-sm">
                    <a href="/parts-requests/{{ $partsRequest->id }}">
                        @include('_partials.statuses.parts-requests', ['status' => $partsRequest->status])
                    </a>
                </td>

                {{-- vehicle registration --}}
                <td class="p-3">
                    <a class="" href="/parts-requests/{{ $partsRequest->id }}">{{ $partsRequest->vehicle_registration }}</a>
                </td>
                
                {{-- vehicle make --}}
                <td class="p-3">
                    <a class="" href="/parts-requests/{{ $partsRequest->id }}">{{ $partsRequest->vehicle_make }}</a>
                </td>

                {{-- vehicle model --}}
                <td class="p-3">
                    <a class="" href="/parts-requests/{{ $partsRequest->id }}">{{ $partsRequest->vehicle_model }}</a>
                </td>

                {{-- delivery postcode --}}
                <td class="p-3">
                    <a class="" href="/parts-requests/{{ $partsRequest->id }}">{{ $partsRequest->delivery_postcode }}</a>
                </td>

                {{-- expiration: tricky ordering, make close to expiring first then convert negative minutes to posotive and add them to arbitary large number to make last --}}
                <td class="p-3 text-sm" data-order="{{ $partsRequest->isExpired() ? abs($partsRequest->getMinutesLeft()) + 10000000 : $partsRequest->getMinutesLeft() }}" title="{{ $partsRequest->formattedCreatedAt() }}">
                    {{ $partsRequest->humanDeadline() }}
                </td>

                {{-- number of bids --}}
                @if ( auth()->user()->isBuyer() )
                <td class="p-3">
                    @if( count($partsRequest->bids) > 0 )
                        @if( $partsRequest->acceptedBid() )
                        <a class="inline-block text-sm text-brand-blue leading-none font-bold" href="/bids/{{ $partsRequest->acceptedBid()->id }}">
                            <span class="pw-btn pw-btn-blue shadow-none">View Bid</span>
                        </a>
                        @else 
                        <a class="inline-block text-sm text-brand-blue leading-none font-bold" href="/parts-requests/{{ $partsRequest->id }}#bids">
                            <span class="">{{ count($partsRequest->bids) }} bids</span>
                        </a>
                        @endif
                    @else
                    <span>No bids</span>
                    @endif
                </td>
                @endif

                {{-- supplier: bid now / your bid  --}}
                @if ( auth()->user()->isSupplier() )
                <td class="p-3 leading-none">
                    
                    {{-- User has bidded --}}
                    @if( auth()->user()->getBid($partsRequest) )
                        
                        {{-- Supplier has bidded and buyer accepted --}}
                        @if( $partsRequest->acceptedBid() == auth()->user()->getBid($partsRequest) )
                        <a href="/bids/{{ auth()->user()->getBid($partsRequest)->id }}">
                            <span class="pw-btn text-white bg-green-600 shadow-none">{{ $partsRequest->confirmedBid() ? 'View Bid' : 'Confirm Delivery' }}</span>
                        </a>
                        @else 
                        <a href="/bids/{{ auth()->user()->getBid($partsRequest)->id }}">
                            <span class="block mb-1">£{{ number_format(auth()->user()->getBid($partsRequest)->totalTradePrice(), 2) }}</span>
                            @include('_partials.statuses.bids', ['status' => auth()->user()->getBid( $partsRequest )->status()])
                        </a>
                        @endif
                        
                    {{-- User yet to bid --}}
                    @else 

                        {{-- there has been another offer accepted so you are rejected. --}}
                        @if( $partsRequest->acceptedBid() || $partsRequest->confirmedBid() )
                        <span class="text-brad-gray-300">Under offer</span>
                        {{-- if not expired then go to allow bid --}}
                        @elseif( !$partsRequest->isExpired() )
                        <a href="/parts-requests/{{ $partsRequest->id }}#bids">
                            <span class="pw-btn pw-btn-blue shadow-none">Quote</span>
                        </a>
                        
                        @else
                            Expired
                        @endif
                    @endif

                </td>
                @endif

            </tr>
        @empty
            {{-- There are no parts requests found --}}
            <tr>
                @if( auth()->user()->isBuyer() )
                <td class="p-3" colspan="7">You don't have any Parts Requests, <a class="text-brand-blue" href="parts-requests/create">create a new one</a>.</td>
                @elseif( auth()->user()->isSupplier() )
                <td class="p-3" colspan="7">There are no eligible Parts Requests. You will recieve an email notification as soon as an eligible request is made.</td>
                @elseif( in_array($userRoleHandles, ['super-admin','admin']) )
                <td class="p-3" colspan="7">No buyers have made any parts requests yet.</td>
                @endif
            </tr>
        @endforelse

    </table>

    @if($partsRequests instanceof \Illuminate\Pagination\AbstractPaginator)
        <footer class="flex">
            <div class="ml-auto bg-white shadow">
                {{ $partsRequests->links() }}
            </div>
        </footer>
    @endif
@endisset

@endsection

@section('js')
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>

$(document).ready( function () {
    $('#js-parts-requests').DataTable({
        language: {
            search: "Search"
        },
        "autoWidth": false,

    });
});
</script>
@endsection