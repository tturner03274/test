@extends('_layouts.app')

@section('document_title', 'View User')

@include('_partials.errors_block')

@section('content')


    <section class="mb-10 bg-white shadow-md rounded-lg">

        <div class="flex p-6 border-b">
            <h1 class="text-2xl text-brand-blue">View User</h1>
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
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->roles()->first()->name,
                        'name' => 'user_role',
                        'label' => 'Type of Account',
                        'classes' => 'w-full',
                        ])
                    </div>

                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->email,
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email Address',
                        'classes' => 'w-full',
                        ])
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
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->company_name,
                        'type' => 'text',
                        'name' => 'company_name',
                        'label' => 'Company Name',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 w-1/2 px-2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->company_registration,
                        'type' => 'text',
                        'name' => 'company_registration',
                        'label' => 'Company Registration Number',
                        'classes' => 'w-full',
                        ])
                    </div>
                    <div class="mb-1 w-1/2 px-2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->limited_company ? 'Limited Company' : 'Not Limited Company',
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
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->telephone,
                        'type' => 'telephone',
                        'name' => 'telephone',
                        'label' => 'Telephone',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>

                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->address_line_1,
                        'type' => 'text',
                        'name' => 'address_line_1',
                        'label' => 'Address Line 1',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->address_line_2,
                        'type' => 'text',
                        'name' => 'address_line_2',
                        'label' => 'Address Line 2',
                        'classes' => 'w-full',
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->town_city,
                        'type' => 'text',
                        'name' => 'town_city',
                        'label' => 'Town / City',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->county,
                        'type' => 'text',
                        'name' => 'county',
                        'label' => 'County',
                        'classes' => 'w-full',
                        'required' => true
                        ])
                    </div>
                    <div class="mb-1 px-2 w-1/2">
                        @include('_partials.forms.row.readonly', [
                        'value' => $user->post_code,
                        'type' => 'text',
                        'name' => 'post_code',
                        'label' => 'Post Code',
                        'classes' => 'w-full',
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
                    'readonly' => true,
                    'value' => implode(',', $user->postcodeAreasArray() ),
                    'name' => 'postcodes_covered',
                    'label' => 'Postcodes Covered',
                    'classes' => 'w-full'
                    ])
                </div>
            </div>

        </div>

    </section>


@endsection