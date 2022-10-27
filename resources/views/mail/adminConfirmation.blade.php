@component('mail::message')
# Greetings,

New meeting reservation was created with the details below.
<br><br>
Facility: <strong>{{ $reservation->room->name }}</strong><br>
Reserved on: <strong>{{ $reservation->date_format }}</strong><br>
Meeting description: <strong>{{ $reservation->remarks }}</strong><br><br>

<p>Reserved by: <strong>{{ $reservation->user->name }}</strong></p>
<br>
<br>



Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
