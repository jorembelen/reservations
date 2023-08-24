@extends('layouts.master')

@section('title', 'Reservations')
@section('content') 


<div class="row">
  
    @livewire('reservations-component')
    
</div>


@endsection
@include('includes.datepicker')
