
@section('script')
<script src="/assets/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr2'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
	var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
		enableTime: true,
		noCalendar: true,
		dateFormat: "H:i",
	});
	var f4 = flatpickr(document.getElementById('timeFlatpickr2'), {
		enableTime: true,
		noCalendar: true,
		dateFormat: "H:i",
	});
</script>
@endsection