
<section class="mb-10 bg-white shadow-md rounded-lg">

        <div class="px-6 py-4 border-b">
            <h1 class="text-2xl leading-tight font-semibold text-brand-blue">Bid</h1>
        </div>
    
        <div class="flex p-10 border-b">
    
            <div class="flex w-full -mx-3">
    
                @php
                $section_fields = [
                ['label' =>"Supplier", 'value' => $bid->user->company_name],
                ['label' =>"Submitted", 'value' => $bid->formattedCreatedAt()],
                ]
                @endphp
                @foreach ($section_fields as $field)
                <div class="w-1/4 px-3">
                    <p>{{$field['label']}}</p>
                    <p class="text-brand-blue font-bold">{{$field['value']}}</p>
                </div>
                @endforeach
    
                <div class="w-1/4 px-3">
                    <p>Decision</p>
                    @include('_partials.statuses.bids', ['status' => $bid->status()])
                </div>
    
                @if( $bid->isAccepted() )
                <div class="w-1/4 px-3">
                    <p>Delivery Due</p>
                    @if( $bid->isConfirmed() )
                    <p class="text-brand-blue font-bold">
                        <i class="far pr-1 fa-calendar-alt"></i> {{ $bid->formattedDeliveryTime() }}
                    </p>
                    @else
                    <p class="font-bold">
                        <i class="far pr-1 fa-clock"></i> TBC
                    </p>
                    @endif
                </div>
                @endif
    
            </div>
        </div>
    
    </section>