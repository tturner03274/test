<section class="mb-10 bg-white shadow-md rounded-lg">

    <div class="flex px-6 py-4 border-b">
        <h1 class="text-2xl font-semibold text-brand-blue">Delivery</h1>
    </div>

    @if( auth()->user()->isSupplier() )
    <div class="flex p-6 py-10 border-b">
        <div class="w-1/4 pr-12">
            <h3 class="font-semibold text-brand-gray-400 text-lg mb-2">Buyer Details</h3>
            <div class="leading-tight text-sm">
                <p></p>
            </div>
        </div>

        <div class="w-3/4">
            <div class="mb-4">
                <p>Buyer</p>
                <p class="text-brand-blue font-bold">{{ $bid->partsRequest->owner->company_name }}</p>
            </div>
            <div class="mb-4">
                <p>Email Address</p>
                <p class="text-brand-blue font-bold"><a href="mailto:{{ $bid->partsRequest->owner->email }}">{{ $bid->partsRequest->owner->email }}</a></p>
            </div>
            <div class="mb-4">
                <p>Telephone</p>
                <p class="text-brand-blue font-bold"><a href="tel:{{ $bid->partsRequest->owner->telephone }}">{{ $bid->partsRequest->owner->telephone }}</a></p>
            </div>
        </div>
    </div>
    @endif
        {{-- No delivery time set yet, show the form to set one if they are the supplier. --}}
        {{-- @if ( null == $bid->partsRequest->acceptedBid()->delivery_time && auth()->user()->isBidOwner($bid) ) --}}
        
        @if ( auth()->user()->can('confirm', $bid) )

        <form action="{{ route('bid.confirm') }}" method="POST">
            @csrf

            <input type="hidden" name="bid_id" value="{{ encrypt($bid->id) }}">
            
            <div class="flex p-6 py-10 border-b">
                <div class="w-1/4 pr-12">
                    <h3 class="font-semibold text-brand-gray-400 text-lg mb-2">Confirm Delivery</h3>
                    <div class="leading-tight text-sm"></div>
                </div>
        
                <div class="w-3/4">

                    <div class="mb-4">
                        <p>Delivery To</p>
                        <p class="text-brand-blue font-bold">{{ $bid->partsRequest->delivery_postcode }}</p>
                    </div>

                    @include('_partials.forms.row.datetime', [
                        'name' => 'delivery_time',
                        'label' => 'Delivery Time',
                        'required' => true,
                        'classes' => 'js-datetime-picker',
                    ])

                    @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'delivery_notes',
                        'label' => 'Delivery Notes',
                        'classes' => 'w-full',
                        'placeholder' => 'e.g. Will be delivered by Andrew',
                    ])

                </div>
            </div>
            
            <div class="p-6 py-10 border-b text-right">
                <input class="pw-btn pw-btn-lg pw-btn-blue" type="submit" value="Confirm Delivery">
            </div>
            
            @include('_partials.errors_block')

        </form>
        @endif

        @if( null == $bid->partsRequest->acceptedBid()->delivery_time && auth()->user() == $bid->partsRequest->owner )
        <div class="p-6 py-10 border-b">
            <p>The delivery confirmation is <strong>to be confirmed</strong> by the supplier.</p>
        </div>
        @endif

        @if( $bid->isConfirmed() )
        <div class="flex w-full">
            <div class="w-1/4">
                <p>Delivery time</p>
                <p class="text-brand-blue font-bold">{{ $bid->formattedDeliveryTime() }}</p>
            </div>
            <div class="w-3/4">
                <p>Delivery notes</p>
                <p class="text-brand-blue font-bold">{{ $bid->delivery_notes ?? 'N/A'}}</p>
            </div>
        </div>
        @endif
            
    
</section>

@section('js')
@parent

<script>
$(document).ready(function(){
    $('.js-datetime-picker').val(moment().hour(23).minute(59).format("YYYY-MM-DDTHH:mm"));
})
</script>

@endsection