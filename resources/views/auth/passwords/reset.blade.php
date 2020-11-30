@extends('_layouts.public')

@section('content')

<section class="py-16">
    <div class="container px-4 flex flex-wrap">
        
        <div class="w-full rounded-lg max-w-sm shadow-md mx-auto">
            
            <form class="bg-brand-blue rounded-lg px-8 py-10" method="POST" action="{{ route('password.update') }}">
                
                <h3 class="mb-4 leading-none text-2xl font-bold text-white">Reset Your Password</h3>
                
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="mb-4">
                    <label class="block text-white mb-2" for="email">Email</label>
                    <input id="email" type="email" class="appearance-none border rounded-sm w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-white mb-2" for="password">Password</label>       
                    <input id="password" type="password" class="appearance-none border rounded-sm w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline" name="password" required autocomplete="new-password">
                    
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-white mb-2" for="password_confirmation">Confirm Password</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="appearance-none border rounded-sm w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline">
                </div>
                
                <div class="flex items-center justify-between">
                    <button class="block ml-auto px-8 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" type="submit">Reset Password</button>
                </div>
                
            </form>
        </div>
        
    </div>
</section>

@endsection
