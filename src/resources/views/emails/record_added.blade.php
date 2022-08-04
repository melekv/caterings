@component('mail::message')
# User added

The user: {{ $email }} has been added to the database.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
