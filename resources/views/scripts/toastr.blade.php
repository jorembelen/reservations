<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });
    window.addEventListener('swal:modal', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });
</script>
<script>
    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('delete', event.detail.id);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.livewire.emit('deleteCancelled');
            }
        })
    });
</script>
