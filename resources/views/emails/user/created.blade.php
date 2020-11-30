@component('mail::message')
# New PartsWeb Account

Welcome to PartsWeb, you can now login using the following details.

@component('mail::button', ['url' => url('/')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
