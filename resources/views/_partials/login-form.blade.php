@guest

<form class="bg-brand-blue rounded-t-lg px-8 py-10" method="POST" action="{{ route('login') }}" accept-charset="UTF-8">

    @csrf
    
    <div class="mb-4">
        <label class="block text-white mb-2" for="username">Email</label>
        <input class="appearance-none border rounded-sm w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline @error('email') border-brand-yellow border-2 @enderror" placeholder="e.g. example@supplier.com" type="text" name="email" value="">
        @error('email')
        <div class="mt-2 p-1 text-sm leading-none text-brand-yellow" role="alert">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-white mb-2" for="password">Password</label>
        <input id="password" type="password" name="password" class="appearance-none border rounded-sm w-full p-3 text-brand-blue leading-tight focus:outline-none focus:shadow-outline @error('password') border-brand-yellow border-2 @enderror">
        @error('password')
        <div class="mt-2 p-1 text-sm leading-none text-brand-yellow" role="alert">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4 text-white">
        <a href="/password/reset">Forgot your password?</a>
    </div>

    <div class="text-right mb-4">
        <button class="block ml-auto px-8 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" type="submit">Login</button>
    </div>

    @if($errors->any())
        <div class="bg-brand-gray-200 border-t-4 border-brand-yellow text-sm p-2 rounded-sm text-brand-blue">{{$errors->first()}}</div>
    @endif

</form>

@else 

<div class="bg-brand-blue rounded-t-lg px-8 py-10 text-white">
    <p class="mb-4">You're logged in as {{ Auth::user()->email }}. <a class="underline" href="{{ url('/logout') }}">Logout?</a></p>
    <p class="text-right"><a class="inline-block ml-auto px-8 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" href="/dashboard">Dashboard</a></p>
</div>

@endif