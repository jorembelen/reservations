<script>
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById('fullcalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                @foreach($reservations as $reservation)
                @if($reservation->date > $modifiedToday)
                {
                    title : '{{ date('h:i a', strtotime($reservation->start_time)) }} - {{ $reservation->room->name }}',
                    start : '{{ $reservation->date }}',
                    color : '{{ $reservation->room->color }}',
                    url: '{{ route('reservations.show',$reservation->id) }}',
                },
                @endif
                @endforeach
            ]
        });
        setTimeout(function() {
            calendar.render();
        }, 250)
    });
</script>