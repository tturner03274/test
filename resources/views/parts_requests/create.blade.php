@extends('_layouts.app')

@section('document_title', 'Create Parts Request')

@section('content')

@include('_partials.errors_block')

<form id="dropzone-form" action="{{ route('parts-requests.store') }}" enctype="multipart/form-data" method="POST">

    @csrf

    <section class="mb-10 bg-white shadow-md rounded-lg">

        <header class="flex p-6 border-b">
            <h1 class="text-2xl font-semibold text-brand-blue">Create New Parts Request</h1>
        </header>

        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Vehicle</h3>
                <div class="leading-tight text-sm">
                    <p>Enter the registration of the vehicle to retrieve the details from the DVLA.</p>
                </div>
            </div>

            <div class="w-2/3" id="vehicle-details">

                @include('parts_requests._create.vehicle')

            </div>

        </div>

        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Parts</h3>
                <div class="leading-tight text-sm">
                    <p>Provide suppliers with details of what parts you are requesting a quote for.</p>
                </div>
            </div>

            <div class="w-2/3">

                @include('parts_requests._create.parts')

            </div>

        </div>

        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Quote</h3>
                <div class="leading-tight text-sm">
                    <p>When and where do you need the parts delivered?</p>
                </div>
            </div>

            <div class="w-2/3">

                @include('parts_requests._create.quote')

            </div>

        </div>

        <div class="p-6">

            <div class="text-right">
                <input class="pw-btn pw-btn-lg pw-btn-blue" type="submit" value="Get Part Quotes">
            </div>

        </div>

    </section>

</form>

@endsection