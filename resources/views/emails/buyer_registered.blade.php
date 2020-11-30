@component('mail::message')
# New Account Application

A user with the email {{ $user->email }} has submitted a new registration.

@component('mail::button', ['url' => url('/')])
Review Application
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
