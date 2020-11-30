@extends('_layouts.public')

@section('document_title', 'Register')

@section('content')

<section class="py-16">
    <div class="container px-4 flex flex-wrap">

        <div class="w-full max-w-xl rounded-lg shadow-md mx-auto">

            <form class="bg-white rounded-lg p-8" method="POST" action="{{ route('register') }}">

                @csrf

                <div class="mb-8">
                    <h3 class="mb-2 leading-none text-2xl font-bold text-brand-blue">Register</h3>
                    <p class="mb-4 leading-tight pb-4">Register an application to become an approved buyer.</p>
                </div>

                @include('_partials.errors_block')

                @includeWhen(session()->has('message'), '_partials.flash_message', ['message' => session()->get('message')])


                <div class="mb-8">
                    <h3 class="text-xl font-bold text-brand-blue leading-none mb-6">Account Details</h3>

                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'placeholder' => 'you@company.co.uk',
                        'required' => true,
                        ])
                    </div>

                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'password',
                        'name' => 'password',
                        'label' => 'Password',
                        'required' => true
                        ])
                    </div>

                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'password',
                        'name' => 'password_confirmation',
                        'label' => 'Confirm Password',
                        'required' => true
                        ])
                    </div>

                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-brand-blue leading-none mb-6">Business Details</h3>

                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'text',
                        'name' => 'company_name',
                        'label' => 'Company Name',
                        'placeholder' => 'e.g. Garage',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'text',
                        'name' => 'company_registration',
                        'label' => 'Company Registration Number',
                        'placeholder' => 'e.g. AB123456',
                        ])
                    </div>
                    <div class="mb-1">
                        @include('_partials.forms.block.boolean', [
                        'name' => 'limited_company',
                        'label' => 'Limited Company?',
                        ])
                    </div>

                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'telephone',
                        'name' => 'telephone',
                        'label' => 'Telephone',
                        'placeholder' => 'e.g. 020 8123 4567',
                        'required' => true
                        ])
                    </div>

                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'text',
                        'name' => 'address_line_1',
                        'label' => 'Address Line 1',
                        'placeholder' => 'e.g. Unit 1',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'text',
                        'name' => 'address_line_2',
                        'placeholder' => 'e.g. High Street',
                        'label' => 'Address Line 2',
                        ])
                    </div>
                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'text',
                        'name' => 'town_city',
                        'label' => 'Town / City',
                        'placeholder' => 'e.g. London',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1">
                        @include('_partials.forms.block.input', [
                        'type' => 'text',
                        'name' => 'post_code',
                        'label' => 'Post Code',
                        'placeholder' => 'e.g. N1 0AB',
                        'required' => true
                        ])
                    </div>

                </div>

                <div class="flex items-center justify-between mt-4">
                    <button class="block ml-auto px-8 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" type="submit">Apply</button>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection