@component('mail::message')
# Quote Received

Your parts request has received a quote.

@component('mail::button', ['url' => url('/')])
View Quotes
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
