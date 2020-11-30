@extends('_layouts.app')
@section('document_title', 'Parts Request ' . str_pad($partsRequest->id, 6, '0', STR_PAD_LEFT))
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endsection

@section('content')

@if( $partsRequest->acceptedBid() )
<div class="rounded-lg p-6 mb-8 bg-white shadow-md">
    <p>This parts request has had a bid accepted. <a class="text-brand-blue" href="/bids/{{ $partsRequest->acceptedBid()->id }}">View the bid.</a></p>
</div>
@endif

<section class=" mb-10 bg-white shadow-md rounded-lg">

    <div class="px-6 py-4 border-b">
        <h1 class="text-2xl font-semibold text-brand-blue">Parts Request </h1>
    </div>

    <div class="flex p-6 py-10 border-b">

        <div class="w-1/4 pr-12">
            <h3 class="font-semibold text-brand-gray-300 text-lg mb-2">Request Details</h3>
            <div class="leading-tight text-sm">
                <p></p>
            </div>
        </div>

        <div class="w-3/4">

            @php
            $section_fields = [
                ['label' =>"Request Ref", 'value' => str_pad($partsRequest->id, 6, '0', STR_PAD_LEFT)],
                ['label' =>"Delivery Postcode", 'value' => $partsRequest->delivery_postcode],
                ['label' =>"Expires", 'value' => $partsRequest->humanDeadline() . ' mins'],
            ]
            @endphp
            <div class="flex w-full -mx-3">
                @foreach ($section_fields as $field)
                <div class="w-1/4 px-3">
                    <p>{{ $field['label'] }}</p>
                    <p class="text-brand-blue font-bold">{{$field['value']}}</p>
                </div>
                @endforeach
                <div class="w-1/4 px-3">
                    <p>Status</p>
                    <p class="font-bold">
                        @include('_partials.statuses.parts-requests', ['status' => $partsRequest->status])
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="flex p-6 py-10 border-b">

        <div class="w-1/4 pr-12">
            <h3 class="font-semibold text-brand-gray-300 text-lg mb-2">Vehicle Details</h3>
            <div class="leading-tight text-sm">
                <p></p>
            </div>
        </div>

        <div class="w-3/4">
            @php
            $section_fields = [
            ['width' =>'w-30', 'label' =>"Vehicle Registration", 'value' => $partsRequest->vehicle_registration],
            ['width' =>'w-24', 'label' =>"Make", 'value' => $partsRequest->vehicle_make],
            ['width' =>'w-24', 'label' =>"Model", 'value' => $partsRequest->vehicle_model],
            ['width' =>'w-40', 'label' =>"Date of First Use", 'value' => $partsRequest->vehicle_year],
            ['width' =>'w-40', 'label' =>"MOT Expiry Date", 'value' => $partsRequest->mot_expiry],
            ]
            @endphp
            <div class="flex w-full -mx-3">
                @foreach ($section_fields as $field)
                <div class="{{ $field['width']}} px-3">
                    <p>{{$field['label']}}</p>
                    <p class="font-bold text-brand-blue">{{$field['value']}}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <div class="flex p-6 py-10 border-b">

        <div class="w-1/4 pr-12">
            <h3 class="font-semibold text-brand-gray-300 text-lg mb-2">Parts Required</h3>
            <div class="leading-tight text-sm">
                <p></p>
            </div>
        </div>

        <div class="w-3/4">
            <div class="mb-6">
                <p>Part Types</p>
                <p class="text-brand-blue font-bold">
                    @foreach($partsRequest->partTypes as $item){{ $loop->first ? '' : ', ' }}{{ $item->name }}@endforeach
                </p>
            </div>
            @if($partsRequest->images->count() > 0)
            <div class="mb-6">
                <p class="">Part Images</p>

                <div class="w-full flex flex-wrap">
                    @foreach ($partsRequest->images as $image)
                    <div class="w-32 mr-2 mb-4 border rounded">
                        <a data-fancybox="gallery" href="{{ url('storage/parts-images/' . $image->filename) }}">
                            <img class="w-32 h-32 object-cover" src="{{ url('storage/parts-images/' . $image->filename) }}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if( $partsRequest->parts_description )
            <div class="mb-6">
                <p>Part Description</p>
                <p class="text-brand-blue font-bold leading-tight">{!! nl2br(e($partsRequest->parts_description)) !!}</p>
            </div>
            @endif
            
        </div>

    </div>

</section>



{{-- If current user is a supplier get the create form --}}

<div id="bids"></div> {{-- for scroll to hash --}}

@if( auth()->user()->hasRole(['supplier']))
    
    @can('bid', $partsRequest)
        @include('parts_requests.bids.supplier.create')
    @endcan

    @if(auth()->user()->hasBidded($partsRequest))
        @include('parts_requests.bids.supplier.show')
    @endif

@endif

{{-- If the user is the buyer that created this request --}}
@if ( auth()->user()->isPartsRequestOwner( $partsRequest ) )
@include('parts_requests.bids.buyer.show')
@endif

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endsection