@extends('layouts.master')

@section('title', 'Calendar')
@section('content') 



    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                    <a class="btn btn-secondary float-right" role="button" href="#" data-toggle="modal" data-target="#create">+ Create Reservation</a>
                </div>
                <div class="card-body">
                    <div id="fullcalendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>
        <!-- BEGIN MODAL -->
        <div class="modal fade none-border" id="create">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Reservation</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('reservations.store') }}" id="res-create">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <select class="form-control select2" name="room_id">
                                        <option value="">Select Rooms . . .</option>
                                        @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="date" placeholder="date" id="dateTimeFlatpickr2">
                                </div>
                                    <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control" name="start_time" placeholder="Start Time" id="timeFlatpickr">
                                </div>
                                    <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control" name="finish_time" placeholder="Finish Time" id="timeFlatpickr2">
                                </div>
                                <div class="form-group">
                                    <textarea name="remarks" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                            <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                            <button type="button" class="btn btn-danger waves-effect disabled-button-prevent" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




@endsection
@include('includes.calendar')
@include('includes.datepicker')

