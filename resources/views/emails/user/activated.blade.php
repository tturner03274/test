@component('mail::message')
# Account Activated

Your account has been activated. Login using your credentials.

@component('mail::button', ['url' => url('/')])
Login To Your Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
