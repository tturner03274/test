{{-- TODO: Hide and show error if expired  --}}

<section class="mb-10 bg-white rounded-lg shadow-md pw-form">
    
    <header class="px-6 py-4 border-b">
        <h2 class="text-2xl font-semibold text-brand-blue">Quote Builder</h2>
        <p class="mb-4">Please start building your quote to bid on the parts request as above.</p>
    </header>

    <main class="px-6 py-4">

        <h3 class="mb-4 text-brand-blue text-lg font-semibold">Your Bid</h3>
        
        <form id="js-bid-form" class="js-bid-form" action="{{ route( 'bids.store', ['partsRequest' => $partsRequest->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="parts_request" value="{{ encrypt($partsRequest->id) }}">

            {{-- labels --}}
            <div class="flex w-100 text-brand-gray-300 font-bold text-sm">
                <div class="w-10 text-brand-gray-400 font-semibold text-left py-2 leading-tight"></div>
                <div class="w-32 px-1 py-2 mr-1 leading-tight text-center">Image</div>
                <div class="flex-1 px-1 py-2 mr-1 leading-tight">Part</div>
                <div class="w-32 px-1 py-2 mr-1 leading-tight">Brand</div>
                <div class="w-24 px-1 py-2 mr-1 leading-tight">Retail Price</div>
                <div class="w-24 px-1 py-2 mr-1 leading-tight">Trade Price</div>
                <div class="w-16 px-1 py-2 mr-1 leading-tight">Qty</div>
                <div class="w-40 px-1 py-2 leading-tight">Availability</div>
            </div>

            <div class="js-parts-rows">

                <div class="js-parts-row flex items-start mb-4 w-full">
                    
                    <div class="js-remove-line w-10 p-3 text-center">
                        <i class="cursor-pointer text-brand-gray-400 hover:text-red-600 far fa-trash-alt"></i>
                    </div>

                    {{-- BidLine Image  --}}
                    <div class="js-image-upload relative w-32 mr-1 text-center">
                        <div class="js-image-upload__button mb-0 cursor-pointer pw-input text-gray-500 text-left"><i class="fas fa-image text-brand-gray-300 pr-1"></i> Image</div>
                        <input required class="js-image-upload__input absolute left-0 bottom-0 overflow-hidden h-px w-px opacity-0 ml-8" name="bid_lines[0][image]" type="file" accept="image/x-png,image/gif,image/jpeg">
                        <img class="js-image-upload__thumbnail hidden mx-auto w-16 h-16 object-cover" src="#" />
                        <a class="js-image-upload__remove hidden text-xs text-red-400 hover:text-red-600" href="#">Remove</a>
                    </div>

                    <input required class="pw-input flex-1 mr-1" name="bid_lines[0][description]" type="text" placeholder="e.g. Flux Capacitor">
                    <input required class="pw-input w-32 mr-1" name="bid_lines[0][brand]" type="text" placeholder="e.g. Aftermarket">
                    <input required class="pw-input w-24 mr-1 js-retail-line" pattern="^\d*(\.\d{0,2})?$" name="bid_lines[0][retail_price]" type="number" step=".01" min="0" placeholder="e.g. £90">
                    <input required class="pw-input w-24 mr-1 js-trade-line" pattern="^\d*(\.\d{0,2})?$" name="bid_lines[0][trade_price]" type="number" step=".01" min="0" placeholder="e.g. £76">
                    <input required class="pw-input w-16 mr-1" name="bid_lines[0][quantity]" type="number" step="1" min="0" value="1">
                    <select required class="pw-input w-40 mr-1" name="bid_lines[0][availability]">
                        @foreach( \App\PartAvailability::all() as $availability )
                        <option value="{{ $availability->id }}">{{ $availability->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="text-right mb-12">
                <button class="js-clone-part-row text-brand-blue font-bold p-2">+ Add another line</button>
            </div>

            <div class="text-right">
                <input class="pw-btn pw-btn-lg pw-btn-blue js-bid-form__submit" type="button" value="Confirm Bid">
            </div>
            <div class="js-ajax-response mt-8 hidden"></div>
        </form>
    </main>
</section>

{{-- Modal Confirmation box --}}
<div class="js-modal hidden fixed top-0 left-0 w-full h-full">
    <div class="js-modal-overlay z-10 fixed top-0 left-0 bg-black w-full h-full opacity-50"></div>
    <div class="relative z-20 mt-64 mx-auto rounded-lg bg-white w-full max-w-lg shadow-xl">
        <div class="flex px-6 py-4 border-b items-center">
            <h1 class="text-lg text-brand-blue font-bold">Confirm Quote</h1>
            <button class="js-toggle-modal ml-auto self-start"><i class="fa fa-times p-2"></i></button>
        </div>
        <div class="p-6 border-b">
            <p class="mb-4 text-base">You are about to place a bid of: <br>
                <span class="text-brand-blue font-semibold">£<span class="js-retail-total"></span> (retail) and £<span class="js-trade-total"></span> (trade)</span>
            </p>
            <p class="text-xs">Please note you <strong>cannot edit</strong> your bid after confirming.</p>
        </div>
        <div class="flex justify-around items-center px-6 py-4">
            <button class="js-modal__edit p-3 hover:text-brand-blue">Edit</button>
            <button class="pw-btn pw-btn-lg bg-green-500 hover:bg-green-600 text-white js-modal__confirm">Confirm Bid</button>
        </div>

    </div>
</div>

@section('js')
@parent
<script>

    // Clone lines
    $('.js-clone-part-row').on('click', function(e) {
        e.preventDefault();
        
        // copy the first row
        var clonedRow = $('.js-parts-row').first().clone(true);

        // Empty all data
        $(clonedRow).find('input').val('');

        // Default value for quantity
        $(clonedRow).find('input[name$="[quantity]"').val('1');

        // Reset image 
        resetImageInput(clonedRow);
        
        // Append to 
        clonedRow.appendTo(".js-parts-rows");
        
        // Set the incrementing input names
        numberInputs();

        // Set the focus to the first new input 
        clonedRow.find('input').first().focus();

    });
    
    // Re-number input indexes
    function numberInputs() {
        $('.js-parts-row').each(function(index) {
            var prefix = "bid_lines[" + index + "]";
            $(this).find("input, select").each(function() {
            this.name = this.name.replace(/bid_lines\[\d+\]/, prefix);   
            });
        }); 
    }

    
    // Remove line
    $('.js-remove-line').on('click', function(e){

        e.preventDefault();

        // As long as we have more than 1 row the line can be deleted
        if ( $('.js-parts-row').length > 1 ){
            $(this).parents('.js-parts-row').slideUp('slow').remove();
        }

        // Set the incrementing input names
        numberInputs();

    });


    // Add better image input
    $('.js-image-upload__button').on('click', function() {
        $(this).next('.js-image-upload__input').trigger('click');
    });

    // Replace input with thumbnail
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $(input).siblings('.js-image-upload__thumbnail').attr('src', e.target.result).fadeIn();
                $(input).siblings('.js-image-upload__remove').fadeIn();
                $(input).siblings('.js-image-upload__button').hide();
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Trigger thumbnail generation
    $('.js-image-upload__input').on('change', function() {
        readURL(this);
    });

    // Remove the thumbnail and re-instantiate
    $('.js-image-upload__remove').on('click', function(e) {
        e.preventDefault();
        resetImageInput($(this).parents('.js-image-upload') );
    });
    
    // Remove the thumbnail from the image input
    function resetImageInput( jsImageUploadDiv ) {
        
        // Hide the thumbnail and remove
        jsImageUploadDiv.find('.js-image-upload__thumbnail').attr('src', '#').hide();
        jsImageUploadDiv.find('.js-image-upload__remove').hide();
        
        // Empty the value
        jsImageUploadDiv.find('.js-image-upload__input').val('');
        
        // Show the button again
        jsImageUploadDiv.find('.js-image-upload__button').fadeIn();
        
    };

    // Force two digit decimal on number
    $('.js-retail-line, .js-trade-line').on('change', function() {
        this.value = parseFloat(this.value).toFixed(2);
    });



    // Show modal on "submit" ( button ) click
    $('.js-bid-form__submit').on('click', function() {
        
        // Manually trigger validation 
        formToValidate = $(this).parents('form')[0]; //note the array key
        if (!formToValidate.checkValidity()) {
            if (formToValidate.reportValidity) {
                formToValidate.reportValidity();
            }
            // Stop further execution
            return false;
        }

        // Empty the error block
        $('.js-ajax-response').hide().html('');

        // Update modal totals
        updateModalTotals();

        // Show the modal
        $('.js-modal').fadeIn();

    });

    // Hide modal when clicked
    $('.js-modal-overlay, .js-toggle-modal, .js-modal__edit').on('click', function() {
        $('.js-modal').fadeOut();
    });

    // Confirm - carry on with submission
    $('.js-modal__confirm').on('click', function() {

        // Set the form data
        var bidForm = document.getElementById("js-bid-form");

        // Submit the formData
        submitForm(bidForm);

    });

    // Submit the form
    function submitForm(bidForm) {

        // Change buttons
        $('.js-modal__confirm').text('Processing...');
        $('.js-modal__confirm').prop('disabled', true);
        $('.js-bid-form__submit').val('Processing...');
        $('.js-bid-form__submit').prop('disabled', true);

        // Get the data from the form
        var formData = new FormData(bidForm);

        $.ajax({
            url: "{!! URL::signedRoute('bids.store', ['partsRequest' => $partsRequest->id]) !!}",
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // TODO: get route to redirect to
                // console.table(response);
                window.location.href = '/parts-requests/' + response.parts_request_id +'/bids/' + response.id + '?success';
            },
            error: function(error) {
                
                // Close the modal
                $('.js-modal').fadeOut();

                // Get the errors
                var errors = error.responseJSON.errors;
                
                // Create a ul element to append to 
                var errorList = $('<ul class="list-disc py-4 px-6">');
                
                $.each(errors, function(index, message) {
                    errorList.append('<li class="leading-tight mb-3 last:mb-0">' + message[0] + '</li>');
                });
                
                // Show error block
                $('.js-ajax-response').addClass('not-valid-block').append(errorList).fadeIn();
                
                // Reset the submit button
                $('.js-modal__confirm').text('Confirm Bid');
                $('.js-modal__confirm').prop('disabled', false);
                $('.js-bid-form__submit').val('Confirm Bid');
                $('.js-bid-form__submit').prop('disabled', false);

            },
        });
    }

    function updateModalTotals() {
        
        var retail = $('.js-retail-total');
        var trade = $('.js-trade-total');
        
        // Reset the total text strings
        retail.text('');
        trade.text('');

        var tradeTotal = 0;
        var retailTotal = 0;

        // Do the total sums
        $('.js-retail-line').each(function (index, element) {
            retailTotal = retailTotal + parseFloat($(element).val());
        });

        $('.js-trade-line').each(function (index, element) {
            tradeTotal = tradeTotal + parseFloat($(element).val());
        });

        // Update the text strings
        retail.text(retailTotal.toFixed(2));
        trade.text(tradeTotal.toFixed(2));

    }



</script>
@endsection