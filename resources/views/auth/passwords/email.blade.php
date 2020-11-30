@extends('_layouts.public')

@section('content')

<section class="py-16">
    <div class="container px-4 flex flex-wrap">

        <div class="w-full rounded-lg max-w-sm shadow-md mx-auto">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="bg-brand-blue rounded-lg px-8 py-10" method="POST" action="{{ route('password.email') }}">
                
                @csrf

                <div class="mb-4">
                    <label class="block text-white mb-2" for="username">Email</label>
                    <input class="appearance-none border rounded-sm w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline " placeholder="e.g. example@supplier.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="text-right mb-4">
                    <button class="block ml-auto px-8 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" type="submit">Send Password Reset Link</button>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection
