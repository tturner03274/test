@extends('_layouts.app')

@section('document_title', 'Users')

@section('content')

@includeWhen(session()->has('message'), '_partials.flash_message', ['message' => session()->get('message')])

<div class="text-right mb-4">
    <a href="/users/create/" class="inline-block px-3 py-2 font-bold text-white bg-brand-blue rounded shadow">+ Add New User</a>
</div>

@isset($users)
<table class="js-user-table mb-12 bg-white w-full shadow-md rounded-lg table-fixed">
    <thead>
        <th class="pw-th w-48">Company</th>
        <th class="pw-th w-auto">User Email</th>
        <th class="pw-th w-40">Role(s)</th>
        <th class="pw-th w-32">Status</th>
        <th class="pw-th w-20">Delete</th>
        <th class="pw-th w-32">&nbsp;</th>
    </thead>

    @foreach ($users as $user)
    <tr class="odd:bg-brand-gray-100 js-user-row" data-user-id="{{ $user->id }}">
        <td class="p-3 text-brand-blue"><a href="/users/{{ $user->id }}">{{ $user->company_name ?? '' }}</a></td>
        <td class="p-3"><a href="/users/{{ $user->id }}">{{ $user->email }}</a></td>
        <td class="p-3">@foreach($user->roles as $role) {{ $role->name }} @endforeach</td>
        <td class="py-2">
            @can('activateSuspend', $user)
            <select data-original-status="{{ $user->active ? 1 : 0 }}" class="js-user-activate p-2 rounded border" >
                <option value="1" {{ $user->active ? 'selected' : ''}}>Active</option>
                <option value="0" {{ !$user->active ? 'selected' : ''}}>Suspended</option>
            </select>                
            @else
            <div class="p-2">{{ $user->active ? 'Active' : 'Suspended' }}</div>
            @endcan
        </td>
        <td class="text-center">
            @can('delete', $user)
            <a class="js-delete-user" href="#"><i class="cursor-pointer text-brand-gray-400 hover:text-red-600 far fa-trash-alt"></i></a>
            @endcan
        </td>
        <td class="js-confirm text-center">
            <button class="js-save-status pw-btn pw-btn-blue hidden" data-action=""><i class="far fa-save pr-1"></i> Save</button>
        </td>
    </tr>
    @endforeach

</table>
@endisset


{{-- Modal Confirmation box --}}
<div class="js-modal hidden fixed top-0 left-0 w-full h-full">
    <div class="js-modal-overlay z-10 fixed top-0 left-0 bg-black w-full h-full opacity-50"></div>
    <div class="relative z-20 mt-64 mx-auto rounded-lg bg-white w-full max-w-lg shadow-xl">
        <div class="flex px-6 py-4 border-b items-center">
            <h1 class="text-lg text-brand-blue font-bold">Confirm Delete</h1>
            <button class="js-toggle-modal ml-auto self-start"><i class="fa fa-times p-2"></i></button>
        </div>
        <div class="p-6 border-b">
            <p class="mb-4 text-base">You are about to delete a user. This action cannot be undone. Are you sure?</p>
        </div>
        <div class="flex justify-around items-center px-6 py-4">
            <button class="js-modal__edit p-3 hover:text-brand-blue">Cancel Deletion</button>
            <button class="pw-btn bg-red-500 hover:bg-red-600 text-white js-modal__confirm"><i class="far fa-trash-alt pr-2"></i>Delete User</button>
        </div>

    </div>
</div>


@endsection

@section('js')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {

        $('.js-user-table').DataTable({
            language: {
                search: "Search"
            }
        });

        // Remove user
        $('a.js-delete-user').on( 'click', function(e) {
            
            e.preventDefault();
            var parentRow = $(this).parents('tr');
            var modalConfirmButton = $('.js-modal__confirm');

             // Show a confirmation modal
            $('.js-modal').fadeToggle();

            // if edit / close / click bg then hide modal and dont continue with submission
            $('.js-modal-overlay, .js-toggle-modal, .js-modal__edit').on( 'click', function() {
                
                // Close the modal
                $('.js-modal').fadeOut();
                
                // Reset button
                submitButton.val(submitTextOriginal);
                submitButton.prop('disabled', false);
                
                // Don't submit the form
                return;

            });

            // if click confirm carry on with submission
            modalConfirmButton.on( 'click', function() {

                $.ajax({
                    type: "DELETE",
                    url: "/users/" + parentRow.data('user-id'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },                
                    success: function(response) {
                        parentRow.slideUp();
                        $('.js-modal').fadeOut();
                    },
                    error: function() {}
                });

            });
        })

        
        // Changing activation
        $('.js-user-row').on('change', '.js-user-activate', function() {
            
            var originalStatus = $(this).attr('data-original-status');
            var statusChangedTo = $(this).val();
            var confirmButton = $(this).parents('tr').find('.js-save-status');
            confirmButton.removeClass('bg-green-500').html('<i class="far fa-save pr-1"></i> Save');

            if ( statusChangedTo == originalStatus ) {
                // Hide button
                confirmButton.hide();
            } else {
                // Show save button
                confirmButton.fadeIn();
                // Update the action
                confirmButton.attr('data-action', statusChangedTo);
            }
        });


        $('.js-save-status').on('click', function(){

            var statusAction = $(this).attr('data-action');
            var parentRow = $(this).parents('tr');
            var confirmButtonText = '<i class="far fa-save pr-1"></i> Save';
            var confirmButton = parentRow.find('.js-save-status');

            // activate user
            if ( statusAction == '1' ) {
                $.ajax({
                    type: "POST",
                    url: "/active-users",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        user_id: parentRow.data('user-id'),
                    },
                    success: function(response) {
                        // console.log('activated');
                        confirmButton.addClass('bg-green-500').html('<i class="fas fa-check pr-1"></i> Updated').fadeOut('slow');
                        parentRow.find('.js-user-activate').attr('data-original-status', '1' );
                    }
                });
            } else {
                $.ajax({
                    type: "DELETE",
                    url: "/active-users/" + parentRow.data('user-id'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // flash
                        confirmButton.addClass('bg-green-500').html('<i class="fas fa-check pr-1"></i> Updated').fadeOut('slow');
                        // update the data-original-status
                        parentRow.find('.js-user-activate').attr('data-original-status', '0' );

                    }
                });
            }
        });

    });
    
</script>
@endsection