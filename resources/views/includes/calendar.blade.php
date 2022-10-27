<script>
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById('fullcalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            selectable:true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: @json($reservations),

            dateClick: ('show-modal', function(event) {
                $('#create').modal('show');
                $('#date').val(event.dateStr);
            }),

        });
        setTimeout(function() {
            calendar.render();
        }, 250)
    });
</script>
