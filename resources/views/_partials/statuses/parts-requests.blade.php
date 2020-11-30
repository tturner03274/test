@if ( $status == 'expired' )
<span class="leading-none font-bold text-red-500">Expired</span>
@elseif( $status == 'bid_accepted' )
<span class="leading-none font-bold text-orange-500">Pending Confirmation</span>
@elseif( $status == 'pending_delivery' )
<span class="leading-none font-bold text-blue-500">Pending Delivery</span>
@elseif( $status == 'completed' )
<span class="leading-none font-bold text-brand-blue">Completed</span>
@else
<span class="leading-none font-bold text-green-500">Open</span>
@endif