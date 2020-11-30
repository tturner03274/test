@if ( $status == 'accepted' )
<span class="leading-none font-bold text-green-500">Accepted</span>
@elseif( $status == 'rejected' )
<span class="leading-none font-bold text-red-500">Rejected</span>
@elseif( $status == 'confirmed' )
<span class="leading-none font-bold text-brand-blue">Delivery Confirmed</span>
@else
<span class="leading-none font-bold text-orange-500">Pending Decision</span>
@endif