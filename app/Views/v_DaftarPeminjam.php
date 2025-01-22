<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-fw fa-hand-holding"></i> <?= $title ?> &raquo; <span class="text-muted"> Daftar Peminjam</span></h4>
</div>
<hr>

<table id="tabelPinjam" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Nama</th>
            <th class="text-center">NIP/NIK</th>
            <th class="text-center">Unit Kerja/Bidang</th>
            <th class="text-center">Tanggal Peminjaman</th>
            <th class="text-center">No. HP</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Jumlah Dokumen Yang Di Pinjam</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($peminjaman as $r): ?>
            <tr>
                <td class="text-center"><?= $i++ ?></td>
                <td class="text-center"><?= $r['nama'] ?></td>
                <td class="text-center"><?= $r['nip'] ?></td>
                <td><?= $r['unit_kerja'] ?></td>
                <td class="text-center"><?= $r['tgl_pinjam'] ?></td>
                <td><?= $r['no_hp'] ?></td>
                <td><?= $r['ket'] ?></td>
                <td class="text-center">
                    <a href="#" class="badge badge-info btnInfo" data-nip="<?= $r['nip'] ?>" data-total="<?= $r['total_dokumen'] ?>" rel="noopener noreferrer"><?= $r['total_dokumen']  ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="detailPinjam" tabindex="-1" role="dialog" aria-labelledby="detailPinjamLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPinjamLabel"><i class="fas fa-fw fa-book"></i> Dokumen Yang Dipinjam (<small id="nama_peminjam"></small> | <small id="nip_nik"></small>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="TableModalPinjam" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Rak</th>
                            <th class="text-center">No. SP2D</th>
                            <th class="text-center">Keterangan/Uraian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <!-- DARI AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('public') ?>/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Cek apakah DataTable sudah diinisialisasi
        if (!$.fn.dataTable.isDataTable('#tabelPinjam')) {
            var table = new DataTable('#tabelPinjam', {
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
                            doc.content[0].text = doc.content[0].text.trim();
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
                            doc.content[1].margin = [20, 0, 20, 0];
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
        }
        $('.btnInfo').on('click', function() {
            var nip = $(this).data('nip'); // Ambil nip dari data-nip link
            var $totalDokumenElement = $(this); // Ambil elemen yang akan diperbarui

            $.ajax({
                url: '<?= base_url("Peminjaman/info") ?>/' + nip,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        alert(data.error); // Jika data tidak ditemukan
                    } else {
                        // Bersihkan tabel sebelum diisi
                        $('.tbody').empty();

                        // Iterasi data untuk setiap dokumen
                        data.forEach(function(item, index) {
                            $('.tbody').append(`
                                <tr>
                                    <td class="text-center">${index + 1}</td>
                                    <td class="text-center">${item.kd_rak}</td>
                                    <td class="text-center">${item.no_sp2d}</td>
                                    <td class="text-center">${item.ket}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger btnKembalikan" data-nip="${nip}" data-id="${item.id}">Di Kembalikan</button>
                                    </td>
                                </tr>
                            `);
                        });

                        // Set nama peminjam
                        $('#nama_peminjam').text(data[0].nama);
                        $('#nip_nik').text(nip);
                    }

                    // Tampilkan modal
                    $('#detailPinjam').modal('show');
                }
            });
        });

        // Event handler untuk tombol "Di Kembalikan"
        $(document).on('click', '.btnKembalikan', function() {
            var id = $(this).data('id'); // Ambil id dari tombol
            var nip = $(this).data('nip'); // Ambil NIP
            var $totalDokumenElement = $(`.btnInfo[data-nip="${nip}"]`); // Temukan elemen total_dokumen yang sesuai
            $.ajax({
                url: '<?= base_url("Peminjaman/updateStatus") ?>',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        alert(response.message);
                        // Hapus baris dari tabel tanpa reload
                        $(`button[data-id="${id}"]`).closest('tr').remove();

                        // Update nilai total_dokumen
                        var totalDokumen = parseInt($totalDokumenElement.data('total')) - 1; // Kurangi 1
                        $totalDokumenElement.data('total', totalDokumen); // Update data-total
                        $totalDokumenElement.text(totalDokumen); // Update tampilan

                        // Cek jika total_dokumen menjadi 0, maka hilangkan row dari tabel utama menggunakan DataTables
                        if (totalDokumen === 0) {
                            // Cari dan hapus baris di tabel utama yang memiliki NIP yang sama
                            var row = table.row($(`#tabelPinjam .btnInfo[data-nip="${nip}"]`).closest('tr'));
                            row.remove().draw(); // Menghapus baris dan memperbarui DataTables
                        }
                    }
                },
                error: function() {
                    alert('Gagal memperbarui status. Silakan coba lagi.');
                }
            });
        });
    });
</script>