
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
                <p>Date:</p>
                <h5 class="card-title mb-0">{{ date('M-d-Y', strtotime($reservation->date)) }}</h5><hr>
                <p>Time:</p>
                <h5 class="card-title mb-0">{{ date('h:i a', strtotime($reservation->start_time)) }} - {{ date('h:i a', strtotime($reservation->finish_time)) }}</h5><hr>
                <p>Reservation Notes:</p>
                <h5 class="card-title mb-0">{{ $reservation->remarks }}</h5><hr>
            </div>
            <div class="modal-footer">
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                <a href="javascript:history.back()" class="btn btn-dark float-right d-print-none "><i class="fas fa-fw fa-step-backward"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>


@endsection