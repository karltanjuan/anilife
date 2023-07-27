@component('mail::message')


Hi {{ $username }},<br>

Welcome to Anilife Veterinary Online Appointment. Thank you for your registration. Before you can start booking an appointment, please verify your email address by clicking the link below:<br><br>

<a href="{{ url('customer/verify-email/') }}/{{ $token }}">Verify email</a><br><br>

Thank you,<br>
{{ env('APP_NAME') }} <br>


If you're having trouble with the link above, copy and paste the URL below into your web browser. <br>

{{ url("customer/verify-email/") }}/{{ $token }}

@endcomponent
