@section('css')
@parent
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endsection

<div class="mb-6">
    <label for="part_types" class="block text-brand-blue font-bold pb-1">Parts Type *</label>

    <select name="part_types[]" class="js-part-types w-full bg-brand-gray-100" multiple="multiple" required>
        {{-- Find predefined old() part types --}}
        @php $found_part_types = App\PartType::find( old('part_types') ) @endphp
        @if ( null !== $found_part_types )
        @foreach( $found_part_types as $part_type )
        <option value="{{ $part_type->id }}" selected>{{ $part_type->name }}</option>
        @endforeach
        @endif

        {{-- Handle newly created old() part types --}}
        @if( is_array(old('part_types')))
        @foreach ( old('part_types') as $item )
        @if( stripos($item, "__") !== false )
        <option value="{{ $item }}" selected>{{ trim($item, "__") }}</option>
        @endif
        @endforeach
        @endif

    </select>

    @error('part_types')
    <div class="mb-3 p-1 text-sm leading-none text-brand-blue" role="alert">{{ $message }}</div>
    @enderror
</div>


<div class="mb-6">
    <label for="parts_images" class="block text-brand-blue font-bold pb-1">Parts Images</label>

    <div class="js-parts-images dropzone relative mb-3 w-full border border-brand-gray-400 bg-brand-gray-100 rounded leading-tight text-sm cursor-pointer" style="min-height: 12rem">
        
    </div>

    @if( is_array(old('parts_images')))
        @foreach ( old('parts_images') as $item )
            <input type="hidden" data-file-reference="{{ $item }}" name="parts_images[]" value="{{ $item }}">
        @endforeach
    @endif

    <div class="js-parts-images__errors hidden bg-brand-yellow text-brand-blue rounded-lg p-2"></div>
</div>


@include('_partials.forms.row.textarea', [
'name' => 'parts_description',
'label' => 'Parts Description',
'placeholder' => 'e.g. Aftermarket catalytic converter part number HG59622109/FG',
'classes' => 'w-full'
])


@section('js')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    $(document).ready(function() {

        // Select2
        $(".js-part-types").select2({
            placeholder: "Select some part types",
            tags: true,
            // get prepopulated types
            ajax: {
                url: "/part-types",
                dataType: "json",
                data: function (params) {
                    var query = {
                        name: params.term,
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item, index) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        }),
                    };
                },
                cache: true
            }, // end ajax

            // on create tag add prefix underscore to show new value in request
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: '__' + term,
                    text: term,
                }
            },

        });


        // Dropzone: See more documentation of code in readme.md 

        var partsImagesDropzone = new Dropzone(".js-parts-images", {
            url: "/parts-requests/images",
            paramName: 'image',
            addRemoveLinks: true,
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
            acceptedFiles: "image/*",
            maxFilesize: 5, // MB
            autoProcessQueue: true,
            dictDefaultMessage: '<i class="fas fa-image text-base text-brand-gray-300 pr-1"></i> Drag photos or click here to upload.',
            success: function(file, response) {
                
                var filename = response;
                
                // Add the default CSS class
                file.previewElement.classList.add("dz-success");
                
                // Set a filename data attr to the preview element using vanilla JS so we can delete the proper hidden input
                file.previewElement.setAttribute('data-file-reference', filename);
                
                // Add a hidden input to the bottom of the form on successful upload
                $('#dropzone-form').append($('<input type="hidden" name="parts_images[]" data-file-reference="' + filename + '" value="' + filename + '">'));

                $('.js-parts-images__errors').text('').hide();

            },
            error: function(file, response) {
                file.previewElement.classList.add("dz-error");
            },
            
        });

        
        // Retain old() values - add them to the dropzone area and the hidden inputs
        // As per https://github.com/enyo/dropzone/wiki/FAQ#how-to-show-files-already-stored-on-server
        
        $('input[name="parts_images[]"').each( function() {
            var mockFile = { name: "Filename", size: 12345 };
            partsImagesDropzone.emit("addedfile", mockFile);
            partsImagesDropzone.emit("thumbnail", mockFile, '/storage/parts-images/temp/' + $(this).val() );
            partsImagesDropzone.emit("complete", mockFile);
            mockFile.previewElement.setAttribute('data-file-reference', $(this).val());
            var existingFileCount = 1; // The number of files already uploaded
            partsImagesDropzone.options.maxFiles = partsImagesDropzone.options.maxFiles - existingFileCount;
        });
        

        // Remove file from appended hidden inputs
        partsImagesDropzone.on("removedfile", function(file) {
            // get the file reference of this file
            var fileReference = file.previewElement.getAttribute('data-file-reference');
            $('input[data-file-reference="' + fileReference + '"]').remove();
        });

        // Error handling too big etc
        partsImagesDropzone.on("error", function(file, response) {
            // Server side error
            if ( response.hasOwnProperty('errors') ) {
                $('.js-parts-images__errors').text(response.errors.image).fadeIn();
            // Client side
            } else {
                $('.js-parts-images__errors').text(response).fadeIn();
            }
            // remove the invalid file
            this.removeFile(file);
        });

        // Disable form submission while a file is still being uploaded
        partsImagesDropzone.on("sending", function() {
            $('#dropzone-form input[type="submit"]').prop('disabled', true);
        });
        
        // Enable form submission after success or failure
        partsImagesDropzone.on("complete", function() {
            $('#dropzone-form input[type="submit"]').removeAttr('disabled');
        });




    });

</script>
@endsection