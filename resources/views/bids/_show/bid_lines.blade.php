@section('css')
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endsection
<section class="mb-10 bg-white shadow-md rounded-lg">

    <div class="flex px-6 py-4 border-b">
        <h1 class="text-2xl font-semibold text-brand-blue">Parts</h1>
    </div>

    <div class="p-10 border-b">

        <table class="js-bid-form bg-white rounded-lg shadow w-full table-fixed">
            
            <thead class="bg-brand-gray-100">
                @if(auth()->user()->can('acceptRejectLines', $bid))
                <th class="text-brand-gray-400 font-semibold text-left p-3 w-12 rounded-tl-lg"></th>
                @endif
                <th class="text-brand-gray-400 font-semibold text-left p-3 w-24">Image</th>
                <th class="text-brand-gray-400 font-semibold text-left p-3 w-auto">Part</th>
                <th class="text-brand-gray-400 font-semibold text-left p-3 w-40">Brand</th>
                <th class="text-brand-gray-400 font-semibold text-left p-3 w-32">Availability</th>
                <th class="text-brand-gray-400 font-semibold text-right p-3 w-32">Quantity</th>
                <th class="text-brand-gray-400 font-semibold text-right p-3 w-32">Retail Price</th>
                <th class="text-brand-gray-400 font-semibold text-right p-3 w-32 rounded-tr-lg">Trade Price</th>
            </thead>


            @foreach ( $bid->lines as $line)
            
            <tr data-bid-line-id="{{ $line->id }}" data-bid-line-hash="{{ encrypt($line->id) }}" class="js-bid-form__row">
            
                @if(auth()->user()->can('acceptRejectLines', $bid))
                <td class="p-3 text-center">
                    <a href="#" class="js-bid-form__edit inline-block leading-none text-base" data-action="{{ $line->isRejected() ? 'add' : 'remove' }}">
                        @if(!$line->isRejected() ) 
                        <i title="Reject Part" class="cursor-pointer p-2 text-brand-gray-300 hover:text-red-600 far fa-trash-alt"></i>
                        @else 
                        <i title="Add Part" class="cursor-pointer p-2 text-brand-gray-400 hover:text-green-600 fas fa-cart-plus"></i>
                        @endif
                    </a>
                </td>
                @endif
            
                <td class="js-bid-form__td {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue">
                    <a data-fancybox="gallery" href="{{ url('storage/bid-lines/' . $line->image_path ) }}">
                        <img class="w-16 h-16 object-cover" src="{{ url('storage/bid-lines/' . $line->image_path ) }}">
                    </a>
                </td>
                <td class="js-bid-form__td {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue">{{ $line->description }}</td>
                <td class="js-bid-form__td {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue">{{ $line->brand }}</td>
                <td class="js-bid-form__td {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue">{{$line->availability->name}}</td>
                <td class="js-bid-form__td {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue text-right">{{$line->quantity}}</td>
                <td class="js-bid-form__td js-bid-form__value--retail {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue text-right">£{{ number_format($line->retail_price, 2) }}</td>
                <td class="js-bid-form__td js-bid-form__value--trade {{ $line->isRejected() ? 'opacity-25 line-through' : 'opacity-100' }} p-3 text-brand-blue text-right">£{{ number_format($line->trade_price, 2) }}</td>
            </tr>

            @endforeach

            <tfoot>
                <td colspan="{{ auth()->user()->hasRole(['buyer']) && !$bid->isAccepted() ? 6 : 5 }}" class="p-3 text-brand-blue font-bold border-t text-right">Total</td>
                <td class="p-3 border-t text-right"><span class="js-bid-form__total--retail inline-block leading-none text-brand-blue font-bold">£{{ number_format($bid->totalRetailPrice(), 2) }}</span></td>
                <td class="p-3 border-t text-right"><span class="js-bid-form__total--trade inline-block leading-none text-brand-blue font-bold">£{{ number_format($bid->totalTradePrice(), 2) }}</span></td>
            </tfoot>
            
        </table>
    </div>

    {{-- Can the current user accept this bid? --}}
    @if ( auth()->user()->can( 'accept', $bid) )
    <div class="p-10">
        <form action="{{ route('bid.accept') }}" method="POST">
            @csrf
            <input type="hidden" name="bid_id" value="{{ encrypt($bid->id) }}">
            <div class="text-right">
                <input class="js-lines-form-submit pw-btn pw-btn-lg pw-btn-blue" type="submit" value="Accept quote">
            </div>
        </form>
    </div>
    @endif

</section>


@section('js')
@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

@if(auth()->user()->can('acceptRejectLines', $bid))

<script>

$(document).ready(function() {

    $('.js-bid-form__row').on( 'click', 'a.js-bid-form__edit', function(e) {
        
        e.preventDefault();
        var parentRow = $(this).parents('tr');

        var addIcon = '<i title="Add Part" class="cursor-pointer p-2 text-brand-gray-400 hover:text-green-600 fas fa-cart-plus"></i>';
        var removeIcon = '<i title="Reject Part" class="cursor-pointer p-2 text-brand-gray-300 hover:text-red-600 far fa-trash-alt"></i>';
        

        if ( $(this).attr('data-action') == 'remove' ) {
            $.ajax({
                type: "DELETE",
                url: "/bid-lines",
                data: {
                    bid_line: parentRow.data('bid-line-hash')
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                
                success: function(response) {

                    // format rejected line
                    parentRow.find('.js-bid-form__td').addClass('opacity-25 line-through').removeClass('opacity-100');
                    
                    // change action from remove to add
                    parentRow.find('.js-bid-form__edit').attr('data-action', 'add').html(addIcon);

                    // if no lines left disable submit
                    if ( $('.js-bid-form [data-action="remove"]').length < 1 ) {
                        $('.js-lines-form-submit').prop('disabled', true);
                    };

                    // Update totals                           
                    $('.js-bid-form__total--retail').text('£' + parseFloat(Math.round(response.total_retail * 100) / 100).toFixed(2));
                    $('.js-bid-form__total--trade').text('£' + parseFloat(Math.round(response.total_trade * 100) / 100).toFixed(2));

                },
            });
        }
        /* We are adding the bid line */
        else {
            $.ajax({
                type: "POST",
                url: "/bid-lines",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                
                data: {
                    bid_line: parentRow.data('bid-line-hash')
                },
                success: function(response) {

                    // format re-added line
                    parentRow.find('.js-bid-form__td').addClass('opacity-100').removeClass('opacity-25 line-through');
                    
                    // change action from remove to add
                    parentRow.find('.js-bid-form__edit').attr('data-action', 'remove').html(removeIcon);

                    // enable button again
                    $('.js-lines-form-submit').removeAttr('disabled');

                    // Recalculate totals
                    $('.js-bid-form__total--retail').text('£' + parseFloat(Math.round(response.total_retail * 100) / 100).toFixed(2));
                    $('.js-bid-form__total--trade').text('£' + parseFloat(Math.round(response.total_trade * 100) / 100).toFixed(2));
                },
            });
        };
    })

});
    
</script>
@endif

@endsection
