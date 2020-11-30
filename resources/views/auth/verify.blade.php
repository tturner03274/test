@extends('_layouts.public')

@section('content')

<section class="py-16">
    <div class="container px-4 flex flex-wrap">
        
        <div class="w-full rounded-lg max-w-sm shadow-md mx-auto">

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <div class="bg-brand-blue rounded-lg px-8 py-10">
                
                <h3 class="mb-4 leading-none text-2xl font-bold text-white">Verify Your Email Address</h3>
                <p>Before proceeding, please check your email for a verification link.</p>
                <p>If you did not receive the email, <a class="text-white" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.</p>
            </div>
        </div>
    </div>
</section>
@endsection
