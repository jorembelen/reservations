<!-- sample modal content -->
<div id="create" class="modal fade" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add User</h5>
                <button type="button" class="close" wire:click.prevent="close">×</button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="state.name" placeholder="Name">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-username" class="col-md-4 ml-3 col-form-label">Username</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="state.username"
                                placeholder="username">
                            @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">Email</label>
                        <div class="col-md-11 ml-3">
                            <input type="email" class="form-control" wire:model.defer="state.email"
                                placeholder="Email">
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-password" class="col-md-4 ml-3 col-form-label">Password</label>
                        <div class="col-md-11 ml-3">
                            <input type="password" class="form-control" wire:model.defer="state.password"
                                placeholder="Password">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Confirm Password</label>
                        <div class="col-md-11 ml-3">
                            <input type="password" class="form-control" id="create_confirm"
                                wire:model.defer="state.password_confirmation" placeholder="Retype Password">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated"
                    role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    Processing . . .</div>
                <div wire:loading wire:target="close"
                    class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status"
                    style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect" wire:click.prevent="close">Close
                    </button>
                </div>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- sample modal content -->
<div id="edit" class="modal fade" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add User</h5>
                <button type="button" class="close" wire:click.prevent="close">×</button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="update('{{ $userId }}')">
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="state.name" placeholder="Name">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-username" class="col-md-4 ml-3 col-form-label">Username</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="state.username"
                                placeholder="username">
                            @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">Email</label>
                        <div class="col-md-11 ml-3">
                            <input type="email" class="form-control" wire:model.defer="state.email"
                                placeholder="Email">
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-password" class="col-md-4 ml-3 col-form-label">Password</label>
                        <div class="col-md-11 ml-3">
                            <input type="password" class="form-control" wire:model.defer="password"
                                placeholder="Password">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Confirm Password</label>
                        <div class="col-md-11 ml-3">
                            <input type="password" class="form-control" id="create_confirm"
                                wire:model.defer="password_confirmation" placeholder="Retype Password">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated"
                    role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    Processing . . .</div>
                <div wire:loading wire:target="close"
                    class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status"
                    style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect" wire:click.prevent="close">Close
                    </button>
                </div>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->