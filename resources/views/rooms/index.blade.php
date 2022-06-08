@extends('layouts.master')

@section('title', 'Rooms')
@section('content') 


<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Conference Rooms List</h4>
                <a class="btn btn-secondary float-right" role="button" href="#" data-toggle="modal" data-target="#create">+ Add Room</a>
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr role="row">
                        <th>#</th>  
                        <th>Name</th>  
                        <th>Color</th> 
                        <th></th> 
                        <th>Action</th>  
                        </thead>
                    <tbody>
                        @foreach ($rooms as $room)   
                        <tr class="even" role="row">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $room->name }}</td>
                           <td>{{ $room->color }}</td>
                            <td style="background-color:{{ $room->color }}" width="12%"> </td>
                            <td class="text-center">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Click</button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="{{ route('rooms.edit', $room->id) }}"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$room->id}}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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
    
    <div class="col-md-3"></div>
</div>



@foreach ($rooms as $room) 
            <!-- Modal -->
            <div class="modal fade" id="delete{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown"></i> Delete this record?</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body m-3">
                        <form class="form-horizontal" method="POST" action="{{ route('rooms.destroy', $room->id) }}">
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

@include('rooms.create')
@endsection
