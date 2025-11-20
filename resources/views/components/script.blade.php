<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('toast-message');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });
            toast.show();
        }
    });
</script>

<!-- DataTables Config -->
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            "lengthMenu": [
                [15, 50, -1],
                [15, 50, 'All'],
            ],
            "language": {
                "lengthMenu": "_MENU_",
                "search": "Telusuri:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": ">",
                    "previous": "<"
                },
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });
    });
</script>
