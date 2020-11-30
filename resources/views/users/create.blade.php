@extends('_layouts.app')

@section('document_title', 'Create New User')

@section('content')

@include('_partials.errors_block')

<form action="/users" method="POST">

    @csrf

    <section class="mb-10 bg-white shadow-md rounded-lg">

        <div class="flex p-6 border-b">
            <h1 class="text-2xl text-brand-blue">Create New User</h1>
        </div>

        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Account</h3>
                <div class="leading-tight text-sm">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere?</p>
                </div>
            </div>

            <div class="w-2/3">
                <div class="-mx-2">
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.select', [
                        'name' => 'user_role',
                        'label' => 'Type of Account',
                        'placeholder' => 'Select a role',
                        'required' => true,
                        'classes' => 'w-full',
                        'options' => [
                        [ 'value' => 'supplier', 'label' => 'Supplier'],
                        /* [ 'value' => 'buyer', 'label' => 'Buyer'], */
                        ]
                        ])
                    </div>

                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'classes' => 'w-full',
                        'placeholder' => 'info@company.co.uk',
                        'required' => true,
                        ])
                    </div>

                    <div class="flex mb-1">
                        <div class="w-1/2 px-2">
                            @include('_partials.forms.row.input', [
                            'type' => 'password',
                            'name' => 'password',
                            'classes' => 'w-full',
                            'label' => 'Password',
                            'required' => true
                            ])
                        </div>

                        <div class="w-1/2 px-2">
                            @include('_partials.forms.row.input', [
                            'type' => 'password',
                            'name' => 'password_confirmation',
                            'label' => 'Confirm Password',
                            'classes' => 'w-full',
                            'required' => true
                            ])
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Company</h3>
                <div class="leading-tight text-sm">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere?</p>
                </div>
            </div>

            <div class="w-2/3">
                <div class="flex flex-wrap -mx-2">
                    <div class="mb-1 w-1/2 px-2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'company_name',
                        'label' => 'Company Name',
                        'placeholder' => 'e.g. Garage',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 w-1/2 px-2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'company_registration',
                        'label' => 'Company Registration Number',
                        'placeholder' => 'e.g. AB123456',
                        'classes' => 'w-full',
                        ])
                    </div>
                    <div class="mb-1 w-1/2 px-2">
                        @include('_partials.forms.row.boolean', [
                        'name' => 'limited_company',
                        'label' => 'Limited Company?',
                        'classes' => 'w-full',
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Contact</h3>
                <div class="leading-tight text-sm">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere?</p>
                </div>
            </div>

            <div class="w-2/3">
                <div class="-mx-2">
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'telephone',
                        'name' => 'telephone',
                        'label' => 'Telephone',
                        'placeholder' => 'e.g. 020 8123 4567',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>

                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'address_line_1',
                        'label' => 'Address Line 1',
                        'placeholder' => 'e.g. Unit 1',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'address_line_2',
                        'placeholder' => 'e.g. High Street',
                        'label' => 'Address Line 2',
                        'classes' => 'w-full',
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'town_city',
                        'label' => 'Town / City',
                        'placeholder' => 'e.g. Chelmsford',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'county',
                        'label' => 'County',
                        'placeholder' => 'e.g. Essex',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.input', [
                        'type' => 'text',
                        'name' => 'post_code',
                        'label' => 'Post Code',
                        'classes' => 'w-full',
                        'placeholder' => 'e.g. N1 0AB',
                        'required' => true
                        ])
                    </div>
                </div>
            </div>

        </div>
        <div class="flex p-6 border-b">

            <div class="w-1/3 pr-12">
                <h3 class="font-bold text-brand-blue text-lg mb-2">Supplier</h3>
                <div class="leading-tight text-sm">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere?</p>
                </div>
            </div>

            <div class="w-2/3">
                <div class="mb-1">
                    @include('_partials.forms.row.textarea', [
                    'name' => 'postcodes_covered',
                    'label' => 'Postcodes Covered',
                    'placeholder' => 'Comma-separated list of partial postcodes e.g. "CM21,IG11"',
                    'required' => true,
                    'classes' => 'w-full'
                    ])
                </div>
            </div>

        </div>

        <div class="p-6">

            <div class="text-right">
                <input class="pw-btn pw-btn-lg pw-btn-blue" type="submit" value="Create New User">
            </div>

        </div>

    </section>

</form>




{{-- 
<div class="max-w-xl mx-auto">
    <h2 class="p-2 text-3xl text-brand-blue">Create New User</h2>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <form action="/users" method="POST">

            @csrf

            <div class="mb-8">
                <h3 class="text-xl font-bold text-brand-blue leading-none mb-6">Account Details</h3>

                <div class="mb-1">
                    @include('_partials.forms.row.input', [
                    'type' => 'email',
                    'name' => 'email',
                    'label' => 'Email Address',
                    'placeholder' => 'info@company.co.uk',
                    'required' => true,
                    ])
                </div>

                

            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold text-brand-blue leading-none mb-6">Business Details</h3>

               

            </div>

            <div class="flex items-center justify-between mt-4">
                <button class="block ml-auto px-8 py-3 font-bold rounded-sm uppercase bg-brand-yellow text-brand-blue" type="submit">Apply</button>
            </div>

        </form>
    </div>
</div>

 --}}

@endsection