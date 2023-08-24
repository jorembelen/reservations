
   
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary float-right" wire:click.prevent="create"><i class="fas fa-plus-circle"></i> Add</a>
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            @if (auth()->user()->id != $user->id)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                  @if ($user->role == '1')
                                  <span class="badge badge-danger">Admin</span>
                                  @else
                                  <span class="badge badge-primary">User</span>
                                  @endif
                                </td>
                            <td class="text-center">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Click</button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" wire:click.prevent="edit('{{$user->id}}')"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                                        <a class="dropdown-item" href="#"  wire:click.prevent="confirmDelete('{{$user->id}}')"><i class="fas fa-fw fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('users.create')
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
            const table = $('.data-table').DataTable();
        });
    </script>
        
    @endpush
