<div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="fullcalendar" class="app-fullcalendar" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN MODAL -->
    <div class="modal fade none-border" id="create" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add New Reservation</strong></h4>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addSchedule">
                        <div class="basic-form">
                            <div class="form-group">
                                <label for="rooms">Conference Room</label>
                                <div wire:ignore>
                                    <select class="form-control select2" wire:model.defer="state.room_id" id="rooms">
                                        <option value="">Select Rooms . . .</option>
                                        @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('room_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date">Reservation Date</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control" wire:model.defer="state.date"  id="date" readonly>
                                </div>
                                @error('date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                <label for="start">Start Time</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control" wire:model.defer="state.start_time" placeholder="add start time" id="timeFlatpickr">
                                </div>
                                @error('start_time')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                <label for="finish">Finish Time</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control" wire:model.defer="state.finish_time" placeholder="add finish time" id="timeFlatpickr2">
                                </div>
                                @error('finish_time')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="finish">Reservation Notes</label>
                                <textarea wire:model.defer="state.remarks" class="form-control"></textarea>
                            </div>

                            <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                <label for="finish">Add Email for CC</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control mb-2" wire:model.defer="emails" placeholder="add email for cc">
                                    <span class="font-13 text-primary">Please separate emails with comma(,)</span>
                                </div>
                                @error('emails')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="alert-message">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        </div>
                        @endif
                        <div class="modal-footer">
                            <div wire:loading wire:target="addSchedule" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                            <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                            <div wire:loading.remove wire:target="addSchedule, close">
                                <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                                <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
<script src="/assets/flatpickr/flatpickr.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    window.addEventListener('swal:modal', event => {
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });
</script>
<script>
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

@include('includes.calendar')

<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#rooms').select2();
        });
    });
</script>
<script>
    window.addEventListener('hide-modal', function (event) {
        $('#create').modal('hide');
        $('#fullcalendar').fullCalendar();
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('state.room_id', $('#rooms').val());
        @this.set('state.date', $('#date').val());
    })
</script>
@endpush
