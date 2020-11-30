@component('mail::message')
# Bid Accepted

Congratulations your bid has been accepted!

@component('mail::button', ['url' => url('/bid/' . {{ $bid->id }} )])
Confirm Delivery
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
