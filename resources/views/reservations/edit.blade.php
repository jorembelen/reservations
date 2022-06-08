@extends('layouts.master')

@section('title', 'Update')
@section('content') 

<div class="row">
    <div class="col-3"></div>
<div class="col-xl-6">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Update {{ $reservation->room->name }}</h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('reservations.update', $reservation->id) }}" id="res-create">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Room Name</label>
                    <div class="col-md-8 mt-1">
                        <select class="form-control select2" name="room_id">
                            <option value="{{ $reservation->room_id }}">{{ $reservation->room->name }}</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Date</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" name="date" value="{{ $reservation->date }}" placeholder="date" id="dateTimeFlatpickr2">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Start Time</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" name="start_time" value="{{ $reservation->start_time }}" placeholder="date" id="timeFlatpickr">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Finish Time</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" name="finish_time" value="{{ $reservation->finish_time }}" placeholder="date" id="timeFlatpickr2">
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <a href="{{ \URL::previous() }}" type="button" class="btn btn-danger waves-effect disabled-button-prevent">Cancel</a>
                </form>
        </div>
    </div>
</div>
<div class="col-3"></div>
</div>
@endsection