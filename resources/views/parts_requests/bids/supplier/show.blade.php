
<section class="mb-10 bg-white rounded-lg shadow-md pw-form">
    <header class="px-6 py-4 border-b">
        <h2 class="text-2xl font-semibold text-brand-blue">Your Bid</h2>
    </header>
    <main class="p-6 py-10">
        <table class="bg-white rounded-lg shadow-md w-full">
            <thead>
                <th class="p-3 text-brand-gray-400 border-b font-semibold text-left">Decision</th>
                <th class="w-32 p-3 text-brand-gray-400 border-b font-semibold text-right">Trade Total</th>
                <th class="w-32 p-3 text-brand-gray-400 border-b font-semibold text-right">Retail Total</th>
                <th class="w-32 p-3 text-brand-gray-400 border-b font-semibold text-left rounded-tr-lg">View Bid</th>
            </thead>
            <tr class="last:rounded-b-lg">
                <td class="p-3">@include('_partials.statuses.bids', ['status' => auth()->user()->getBid( $partsRequest )->status()])</td>
                <td class="p-3 text-brand-blue text-right">£{{ number_format(auth()->user()->getBid($partsRequest)->totalTradePrice(), 2) }}</td>
                <td class="p-3 text-brand-blue text-right">£{{ number_format(auth()->user()->getBid($partsRequest)->totalRetailPrice(), 2) }}</td>
                <td class="p-3"><a class="inline-block text-white rounded bg-brand-blue p-2 px-3 leading-none font-semibold" href="/bids/{{ auth()->user()->getBid($partsRequest)->id }}">View Bid</a></td>
            </tr>
        </table>
    </main>
</section>