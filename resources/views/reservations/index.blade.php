@extends('layouts.master')

@section('title', 'Reservations')
@section('content') 


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-secondary float-right" role="button" href="#" data-toggle="modal" data-target="#create">+ Create New</a>
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr role="row">
                        <th>#</th>  
                        <th>Room</th>  
                        <th>Date</th> 
                        <th>Time</th> 
                        <th>Notes</th> 
                        <th>Action</th>  
                        </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)   
                        <tr class="even" role="row">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reservation->room->name }}</td>
                            <td>{{ date('M-d-Y', strtotime($reservation->date)) }}</td>
                            <td>{{ date('h:i a', strtotime($reservation->start_time)) }} - {{ date('h:i a', strtotime($reservation->finish_time)) }}</td>
                            <td>{{ $reservation->remarks }}</td>
                            <td class="text-center">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Click</button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="{{ route('reservations.edit', $reservation->id) }}"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$reservation->id}}"><i class="fas fa-fw fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-2"></div>
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
                          <input type="text" class="form-control input-rounded" name="date" placeholder="reservation date" id="dateTimeFlatpickr2">
                      </div>
                          <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                          <input type="text" class="form-control input-rounded" name="start_time" placeholder="Start Time" id="timeFlatpickr">
                      </div>
                          <div class="form-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                          <input type="text" class="form-control input-rounded" name="finish_time" placeholder="Finish Time" id="timeFlatpickr2">
                      </div>
                      <div class="form-group">
                          <textarea name="remarks" class="form-control input-rounded"></textarea>
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

@foreach ($reservations as $reservation) 
            <!-- Modal -->
            <div class="modal fade" id="delete{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown"></i> Delete this record?</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body m-3">
                        <form class="form-horizontal" method="POST" action="{{ route('reservations.destroy', $reservation->id) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                        <h5 class="mb-0 text-center">If you delete the data it will be gone forever. Are you sure you want to proceed?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Delete</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
                    
@endforeach

@endsection
@include('includes.datepicker')
