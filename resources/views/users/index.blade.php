@extends('layouts.master')

@section('title', 'Users')
@section('content')

    <div class="row">
        <div class="col-2"></div>
            @livewire('users-component')
        <div class="col-2"></div>
    </div>

    


    {{-- @foreach ($users as $user)
        <!-- Modal -->
        <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleStandardModalLabel"><i
                                class="align-middle mr-2 far fa-fw fa-frown"></i> Delete this record?</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form class="form-horizontal" method="POST" action="{{ route('users.destroy', $user->id) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <h5 class="mb-0 text-center">If you delete the data it will be gone forever. Are you sure you
                                want to proceed?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Delete</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

@endsection
