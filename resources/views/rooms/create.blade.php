
  <!-- BEGIN MODAL -->
  <div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Add Room</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('rooms.store') }}" id="room-create">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="room name">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="color">
                                <option value="">Select Color ...</option>
                                <option value="#FF0000" style="background-color:#FF0000">Red</option>
                                <option value="#0000FF" style="background-color:#0000FF">Blue</option>
                                <option value="#FF00FF" style="background-color:#FF00FF">Fuchsia</option>
                                <option value="#000000" style="background-color:#000000">Black</option>
                                <option value="#800080" style="background-color:#800080">Purple</option>
                            </select>
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