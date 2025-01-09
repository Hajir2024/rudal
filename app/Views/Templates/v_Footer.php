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
<script src="<?= base_url('public') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('public') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('public') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('public') ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('public') ?>/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('public') ?>/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('public') ?>/js/demo/chart-pie-demo.js"></script>

<!-- DataTables Button -->
<script src="<?= base_url('public/js/dataTables') ?>/jquery.dataTables.min.js"></script>

<script src="<?= base_url('public/js/dataTables') ?>/dataTables.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/dataTables.buttons.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/buttons.bootstrap4.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/jszip.min.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/pdfmake.min.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/vfs_fonts.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/buttons.html5.min.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/buttons.print.min.js"></script>
<script src="<?= base_url('public/js/dataTables') ?>/buttons.colVis.min.js"></script>



<!-- Chained Select -->
<script src="<?= base_url('public/') ?>js/jquery.chained.js"></script>

<!-- Costum Script -->
<script src="<?= base_url('public/') ?>js/my_script.js"></script>

<!-- <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            columnDefs: [{
                targets: -1,
                visible: false
            }],
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'colvis',
                        postfixButtons: ['colvisRestore']
                    }]
                }
            }
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

    function editFileName() {
        // Ambil elemen input file
        var fileInput = document.getElementById('editFile');
        var fileName = fileInput.files[0].name; // Ambil nama file yang dipilih
        // Update label untuk menampilkan nama file
        var label = fileInput.nextElementSibling;
        label.innerText = fileName;
    }

    $("#id_subkeg").chained("#id_bid");
</script> -->

<script>
    $(document).ready(function() {
        new DataTable('#myTable', {
            columnDefs: [{
                targets: [4, 6, 7, 8, 9, 10],
                visible: false
            }],
            dom: '<"d-flex justify-content-between align-items-center mb-3"Blf>rt<"d-flex justify-content-between align-items-center mt-3"<"col-md-6"i><"col-md-6 d-flex justify-content-end"p>>',
            buttons: [{
                    extend: 'pdfHtml5',
                    message: '',
                    text: '<img src="<?= base_url('public/img/pdf.png') ?>" width="30">', // Custom button icon
                    className: 'btn btn-light',
                    title: 'Data Arsip Dokumen',
                    titleAttr: "Export PDF",
                    orientation: 'landscape',
                    pageSize: 'legal',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(doc) {
                        doc.pageMargins = [30, 20, 30, 20];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 10;
                        doc.styles.title.fontSize = 20;
                        doc.styles.title.bold = true;
                        // Remove spaces around page title
                        doc.content[0].text = doc.content[0].text.trim();
                        // Footer customization
                        doc.footer = function(currentPage, pageCount) {
                            return {
                                columns: [{
                                        text: 'Printed By: Ruang Arsip Digital (RUDAL)',
                                        alignment: 'left',
                                        italics: true,
                                        color: '#0000ff',
                                        margin: [43, 0, 30, 20],
                                    },
                                    {
                                        text: 'Page ' + currentPage.toString() + ' of ' + pageCount.toString(),
                                        alignment: 'right',
                                        margin: [0, 0, 43, 20]
                                    }
                                ],
                                margin: [5, 5]
                            };
                        };

                        doc.header = function(currentPage, pageCount) {
                            return {
                                columns: [{
                                    text: 'Printed at: <?= hari_ini() ?>, <?= date('d/m/Y') ?>, <?= date('H:i:s', strtotime('+1 hours')) ?>',
                                    alignment: 'right',
                                    color: '#cccccc',
                                    margin: [0, 0, 43, 20],
                                }],
                                margin: [5, 5]
                            };
                        };

                        // Styling the table: create style object
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return 0.5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return 0.5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };

                        doc.content[1].layout = objLayout;
                        doc.content[1].margin = [20, 0, 20, 0]; // left, top, right, bottom
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<img src="<?= base_url('public/img/xls.png') ?>" width="30">', // Custom button icon
                    className: 'btn btn-light',
                    title: 'Data Arsip Dokumen',
                    titleAttr: "Export Excel"
                }, 
                {
                    extend: 'colvis',
                    text: '<img src="<?= base_url('public/img/list.png') ?>" width="25">', // Custom button icon
                    className: 'btn btn-light',
                    titleAttr: "Show/Hidden Columns",
                    postfixButtons: ['colvisRestore']
                }
            ]
        });
        new DataTable('#TablePinjam', {
            columnDefs: [{
                // targets: [],
                visible: false
            }],
            dom: '<"d-flex justify-content-between align-items-center mb-3"Blf>rt<"d-flex justify-content-between align-items-center mt-3"<"col-md-6"i><"col-md-6 d-flex justify-content-end"p>>',
            buttons: [{
                    extend: 'pdfHtml5',
                    message: '',
                    text: '<img src="<?= base_url('public/img/pdf.png') ?>" width="30">', // Custom button icon
                    className: 'btn btn-light',
                    title: 'Data Arsip Dokumen',
                    titleAttr: "Export PDF",
                    orientation: 'landscape',
                    pageSize: 'legal',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(doc) {
                        doc.pageMargins = [30, 20, 30, 20];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 10;
                        doc.styles.title.fontSize = 20;
                        doc.styles.title.bold = true;
                        // Remove spaces around page title
                        doc.content[0].text = doc.content[0].text.trim();
                        // Footer customization
                        doc.footer = function(currentPage, pageCount) {
                            return {
                                columns: [{
                                        text: 'Printed By: Ruang Arsip Digital (RUDAL)',
                                        alignment: 'left',
                                        italics: true,
                                        color: '#0000ff',
                                        margin: [43, 0, 30, 20],
                                    },
                                    {
                                        text: 'Page ' + currentPage.toString() + ' of ' + pageCount.toString(),
                                        alignment: 'right',
                                        margin: [0, 0, 43, 20]
                                    }
                                ],
                                margin: [5, 5]
                            };
                        };

                        doc.header = function(currentPage, pageCount) {
                            return {
                                columns: [{
                                    text: 'Printed at: <?= hari_ini() ?>, <?= date('d/m/Y') ?>, <?= date('H:i:s', strtotime('+1 hours')) ?>',
                                    alignment: 'right',
                                    color: '#cccccc',
                                    margin: [0, 0, 43, 20],
                                }],
                                margin: [5, 5]
                            };
                        };

                        // Styling the table: create style object
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return 0.5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return 0.5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };

                        doc.content[1].layout = objLayout;
                        doc.content[1].margin = [20, 0, 20, 0]; // left, top, right, bottom
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<img src="<?= base_url('public/img/xls.png') ?>" width="30">', // Custom button icon
                    className: 'btn btn-light',
                    title: 'Data Arsip Dokumen',
                    titleAttr: "Export Excel"
                }, 
                {
                    extend: 'colvis',
                    text: '<img src="<?= base_url('public/img/list.png') ?>" width="25">', // Custom button icon
                    className: 'btn btn-light',
                    titleAttr: "Show/Hidden Columns",
                    postfixButtons: ['colvisRestore']
                }
            ]
        });
    });

    showTime();
</script>
</body>

</html>