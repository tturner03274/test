@if ( count( auth()->user()->getBids( $partsRequest->id ) ) > 0 )

<table class="mb-12 bg-white rounded-lg shadow-md w-full">
    <thead>
        <th class="w-auto p-3 text-brand-gray-400 border-b font-semibold text-left rounded-tl-lg">Supplier</th>
        <th class="w-32 p-3 text-brand-gray-400 border-b font-semibold text-right">Trade Total</th>
        <th class="w-32 p-3 text-brand-gray-400 border-b font-semibold text-right">Retail Total</th>
        <th class="w-48 p-3 text-brand-gray-400 border-b font-semibold text-left">Bidded</th>
        <th class="w-48 p-3 text-brand-gray-400 border-b font-semibold text-left">Decision</th>
        <th class="w-32 p-3 text-brand-gray-400 border-b font-semibold text-left rounded-tr-lg">View Bid</th>
    </thead>
    @foreach (auth()->user()->getBids( $partsRequest->id ) as $bid )
    <tr class="odd:bg-brand-gray-100 last:rounded-b-lg">
        <td class="p-3 text-brand-blue"><a class="" href="/bids/{{ $bid->id }}">{{ $bid->user->company_name }}</a></td>
        <td class="p-3 text-brand-blue text-right">£{{ number_format($bid->totalTradePrice(), 2) }}</td>
        <td class="p-3 text-brand-blue text-right">£{{ number_format($bid->totalRetailPrice(), 2) }}</td>
        <td class="p-3 text-brand-blue">{{ $bid->created_at->diffForHumans() }}</td>
        <td class="p-3">@include('_partials.statuses.bids', ['status' => $bid->status()])</td>
        <td class="p-3"><a class="inline-block text-white rounded bg-brand-blue p-2 px-3 leading-none font-semibold" href="/bids/{{ $bid->id }}">View Bid</a></td>
    </tr>
    @endforeach
</table>

@else
    <p class="text-center"><i class="text-brand-gray-400 pr-2 far fa-clock"></i> No bids have been placed on this parts request yet.</p>
@endif
