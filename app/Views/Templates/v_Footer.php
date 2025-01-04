</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer" style="position: fixed; bottom: 0; width: 100%; text-align: center;">
    <div class="container my-auto">
        <div class="copyright text-center" style="margin-bottom: -12px;">
            <span>Copyright &copy; RUDAL - <strong>2024</strong></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('public/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('public/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('public/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('public/') ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('public/') ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('public/') ?>js/demo/chart-pie-demo.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<!-- Chained Select -->
<script src="<?= base_url('public/') ?>js/jquery.chained.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip', // Menambahkan tombol export dan visibility
            buttons: [{
                    extend: 'excelHtml5', // Export ke Excel
                    exportOptions: {
                        columns: ':visible' // Hanya kolom yang terlihat yang diekspor
                    }
                },
                {
                    extend: 'pdfHtml5', // Export ke PDF
                    exportOptions: {
                        columns: ':visible' // Hanya kolom yang terlihat yang diekspor
                    }
                },
            ]
        });
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function updateFileName() {
        // Ambil elemen input file
        var fileInput = document.getElementById('file');
        var fileName = fileInput.files[0].name; // Ambil nama file yang dipilih
        // Update label untuk menampilkan nama file
        var label = fileInput.nextElementSibling;
        label.innerText = fileName;
    }

    $("#id_subkeg").chained("#id_bid");
</script>

</body>

</html>