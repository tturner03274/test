@extends('_layouts.app')
@section('content')

    <h1 class="text-4xl text-brand-blue font-bold mb-12">{{ Auth::user()->roles()->first()->name }} Dashboard</h1>  

@endsection