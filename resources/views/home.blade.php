@extends('_layouts.public')

@section('document_title', 'Sourcing Spare Parts for the Motor Industry')

@section('content')

<section class="py-16 mb-8">
    <div class="container px-4 flex flex-wrap">

        <div class="w-full rounded-lg max-w-sm shadow-md self-start">

            @include('_partials.login-form')

            <div class="rounded-b-lg p-6 bg-brand-gray-100 text-brand-blue text-center">
                <p>Want to become a buyer? <a href="/register" class="border-b-2 border-brand-yellow pb-1">Register here</a>.</p>
            </div>

        </div>

        <div class="flex-1 pl-16 relative">
            <h2 class="relative z-10 py-16 pr-10 mb-64 text-5xl leading-none font-bold text-brand-blue text-left">Getting the motor trade the parts they need. <em>Fast.</em></h2>
            <img class="absolute bottom-0 right-0" src="{{ asset('images/partsweb-van.png') }}" alt="">
        </div>

    </div>
</section>

<section class="py-8 relative" style="min-height: 438px">
    
    <svg class="absolute top-0 left-0 w-full" width="1400" height="438" viewBox="0 0 1400 438" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.14441e-05 0.00134277L1400 0.00134277L1400 437.5L1.14441e-05 361.001L1.14441e-05 0.00134277Z" fill="#0B0A3D"/>
    </svg>
    
    <div class="relative z-10 container px-4 text-center text-white mb-8">
        <h2 class="font-bold text-4xl">How does PartsWeb work?</h2>
        <p class="text-lg">Bringing motor part suppliers and buyers together on one platform.</p>
    </div>

    <div data-aos="fade-up" data-aos-offset="100" class="relative z-10 container px-4 flex flex-wrap justify-center">
        <img src="{{ asset('images/mockup.png') }}" alt="">
    </div>

</section>

<section class="py-16">
    <div class="container px-4 flex flex-wrap">
        
        <div class="w-1/2 px-6 border-r border-brand-gray-100">
            <header class="text-center mb-12">
                <img class="inline-block" src="{{ asset('images/icons/car-mechanic-light.svg') }}">
                <h2 class="text-brand-blue font-bold text-4xl">For Garages & Buyers</h2>
            </header>
            <main class="flex flex-wrap">
                @for ($i = 0; $i < 4; $i++)
                <div class="w-1/2 mb-12 px-3">
                    <h4 class="text-brand-blue text-lg mb-2 leading-tight">Feature/Benefit</h4>
                    <p class="text-sm">Id est enim, de quo quaerimus. Id Sextilius factum negabat. Si verbum sequimur,</p>
                </div>                
                @endfor
            </main>
        </div>
        
        <div class="w-1/2 px-6">
            <header class="text-center mb-12">
                <img class="inline-block" src="{{ asset('images/icons/truck-light.svg') }}">
                <h2 class="text-brand-blue font-bold text-4xl">For Car Parts Suppliers</h2>
            </header>
            <main class="flex flex-wrap">
                @for ($i = 0; $i < 4; $i++)
                <div class="w-1/2 mb-12 px-3">
                    <h4 class="text-brand-blue text-lg mb-2 leading-tight">Feature/Benefit</h4>
                    <p class="text-sm">Id est enim, de quo quaerimus. Id Sextilius factum negabat. Si verbum sequimur,</p>
                </div>                
                @endfor
            </main>
        </div>
    </div>
</section>


<section class="py-16">
    <div class="container px-4 text-center mb-8">
        <h2 class="text-brand-blue font-bold text-4xl">Featured Suppliers</h2>
    </div>
    <div class="px-4 flex flex-wrap justify-center overflow-x-hidden items-center">
        <img class="mx-12" src="{{ asset('images/logos/euro.png') }}" alt="">
        <img class="mx-12" src="{{ asset('images/logos/gsf.png') }}" alt="">
        <img class="mx-12" src="{{ asset('images/logos/british-parts.png') }}" alt="">
        <img class="mx-12" src="{{ asset('images/logos/motor-parts-direct.png') }}" alt="">
        <img class="mx-12" src="{{ asset('images/logos/ngk.png') }}" alt="">
    </div>
</section>

@endsection