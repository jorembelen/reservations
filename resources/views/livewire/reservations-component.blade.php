
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary float-right" wire:click.prevent="create">+ Create New</a>
        </div>
        <div class="card-body">
            <table id="{{ $showTable ? null : 'data-tables' }}" class="table table-striped dataTable no-footer dtr-inline">
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
                                    <a class="dropdown-item" wire:click.prevent="edit('{{$reservation->id}}')"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                                    <a class="dropdown-item" href="#"  wire:click.prevent="confirmDelete('{{$reservation->id}}')"><i class="fas fa-fw fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('reservations.edit')
</div>


@push('js')
<script>
    window.addEventListener('show-modal', function (event) {
        $('#create').modal('show');
    });
    window.addEventListener('show-edit-modal', function (event) {
        $('#edit').modal('show');
    });
    window.addEventListener('hide-modal', function (event) {
        $('#create').modal('hide');
        $('#edit').modal('hide');
    });
    window.addEventListener('showTable', function (event) {
        $("#data-tables").DataTable({
            responsive: true
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Datatables Responsive
        $("#data-tables").DataTable({
            responsive: true
        });
    });
</script>
@endpush