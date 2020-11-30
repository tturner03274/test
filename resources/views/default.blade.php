@extends('_layouts.public')

@section('content')

<section class="py-16">
    <div class="container px-4 flex flex-wrap">

        <div class="w-full max-w-xl rounded-lg shadow-md mx-auto">
            {{ $content }}
        </div>

    </div>
</section>

@endsection