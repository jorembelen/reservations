@extends('layouts.master')

@section('title', 'Update')
@section('content') 

<div class="row">
    <div class="col-3"></div>
<div class="col-xl-6">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Update {{ $room->name }}</h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('rooms.update', $room->id) }}" id="res-create">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Name</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" name="name" value="{{ $room->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Name</label>
                    <div class="col-md-8 mt-1">
                        <select class="form-control" name="color">
                            <option value="{{ $room->color }}" style="background-color: {{ $room->color }}">{{ $room->color }}</option>
                            <option value="#FF0000" style="background-color:#FF0000">Red</option>
                            <option value="#0000FF" style="background-color:#0000FF">Blue</option>
                            <option value="#FF00FF" style="background-color:#FF00FF">Fuchsia</option>
                            <option value="#000000" style="background-color:#000000">Black</option>
                            <option value="#800080" style="background-color:#800080">Purple</option>
                        </select>
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