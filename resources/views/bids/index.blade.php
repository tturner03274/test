@extends('_layouts.app')

@section('content')

@isset($bids)

<table id="js-bid-table" class="mb-8 bg-white rounded-lg shadow-md w-full table-fixed">
    <thead>
        <th class="pw-th cursor-pointer w-48">Status</th>
        <th class="pw-th cursor-pointer w-auto">Vehicle Registration</th>
        <th class="pw-th cursor-pointer w-auto">Make</th>
        <th class="pw-th cursor-pointer w-auto">Model</th>
        <th class="pw-th cursor-pointer w-48">Bid Value</th>
        <th class="pw-th cursor-pointer w-48">Delivery Due</th>
    </thead>
    @forelse ($bids as $bid)
    <tr class="odd:bg-brand-gray-100">
        <td class="p-3">@include('_partials.statuses.bids', ['status' => $bid->status()])</td>
        <td class="p-3"><a href="/bids/{{ $bid->id }}">{{ $bid->partsRequest->vehicle_registration }}</a></td>
        <td class="p-3">{{ $bid->partsRequest->vehicle_make }}</td>
        <td class="p-3">{{ $bid->partsRequest->vehicle_model }}</td>
        <td class="p-3">£{{ number_format($bid->totalTradePrice(), 2) }}</td>
        @if( $bid->isConfirmed() )
        <td class="p-3 text-brand-blue">{{ $bid->formattedDeliveryTime() }}</td>
        @else 
        <td class="p-3">TBC</td>
        @endif
    </tr>
    @empty
    <tr>
        <td class="p-3" colspan="6">No bids found.</td>
    </tr>
    @endforelse

</table>
@endisset

@endsection

@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#js-bid-table').DataTable({
        language: {
            search: "Search"
        }
    });
});
</script>
@endsection