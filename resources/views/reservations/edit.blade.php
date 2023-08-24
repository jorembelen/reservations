<!-- BEGIN MODAL -->
<div class="modal fade" id="create" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add New Reservation</strong></h4>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form wire:submit.prevent="submit('{{ $reservationId }}')">
                        <div class="form-group">
                            <select class="form-control select2" wire:model.defer="state.room_id">
                                <option value="">Select Rooms . . .</option>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                            @error('room_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-rounded" wire:model.defer="state.date" placeholder="reservation date" id="dateTimeFlatpickr2">
                            @error('date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                            <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control input-rounded" wire:model.defer="state.start_time" placeholder="Start Time" id="timeFlatpickr">
                            @error('start_time')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                            <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control input-rounded" wire:model.defer="state.finish_time" placeholder="Finish Time" id="timeFlatpickr2">
                            @error('finish_time')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <textarea wire:model.defer="state.remarks" class="form-control input-rounded"></textarea>
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
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated"
                    role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    Processing . . .</div>
                <div wire:loading wire:target="close"
                    class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status"
                    style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect" wire:click.prevent="close">Close
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
  </div>