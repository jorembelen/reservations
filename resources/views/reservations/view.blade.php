
@extends('layouts.master')

@section('title', 'Details')
@section('content')


<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <p>Room Name:</p>
                <h3 class="card-title mb-0">{{ $reservation->room->name }}</h3>
            </div>
            <hr>
            <div class="card-body">
                <p>Scheduled Date and Time:</p>
                <h5 class="card-title mb-0">{{ $reservation->date_format }}</h5><hr>
                <p>Reservation Notes:</p>
                <h5 class="card-title mb-0">{{ $reservation->remarks }}</h5><hr>
            </div>
            <div class="modal-footer">
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                <a href="{{ route('dashboard') }}" class="btn btn-dark float-right d-print-none "><i class="fas fa-fw fa-step-backward"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>


@endsection
