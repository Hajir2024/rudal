<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-book"></i> <?= $title ?></h4>
    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> TAMBAH</button>
</div>
<hr>
<!-- Content Row -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success..!!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed..!!</strong> <?= session()->getFlashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<table id="myTable" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kode Rak</th>
            <th class="text-center">Kode Box</th>
            <th class="text-center">No. SP2D</th>
            <!-- <th class="text-center">No. Kontrak</th> -->
            <!-- <th class="text-center">Bidang</th> -->
            <!-- <th class="text-center">Sub Kegiatan</th> -->
            <th class="text-center">Keterangan</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($dokumen as $r): ?>
            <tr>
                <td class="text-center"><?= $i++ ?></td>
                <td class="text-center"><?= $r['kd_rak'] ?></td>
                <td class="text-center"><?= $r['kd_box'] ?></td>
                <td><?= $r['no_sp2d'] ?></td>
                <!-- <td><?= $r['no_kontrak'] ?></td> -->
                <!-- <td><?= $r['bidang'] ?></td> -->
                <!-- <td><?= $r['sub_kegiatan'] ?></td> -->
                <td><?= $r['ket'] ?></td>
                <td class="text-center">
                    <?php if ($r['status'] == 'TIDAK ADA') : ?>
                        <a href="#" class="badge badge-info" data-placement="left" title="Info Peminjaman">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    <?php endif; ?>
                    <a href="#" class="badge badge-success btn-edit" data-id="<?= $r['id'] ?>" data-placement="left" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="badge badge-warning btn-detail" data-id="<?= $r['id'] ?>" data-placement="top" title="Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?= base_url('public/uploads/' . $r['file'] . '') ?>" target="_blank" class="badge badge-primary" data-placement="down" title="Download">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="badge badge-danger btn-delete" data-id="<?= $r['id'] ?>" data-placement="right" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- TAMBAH MODAL -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="exampleModalLabel">
                    <i class="fas fa-plus-circle"></i> Tambah Dokumen
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Dokumen/simpan') ?>" method="POST" class="text-gray-900" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Kolom pertama -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kd_rak">Kode Rak</label>
                                <input type="text" class="form-control form-control-sm" id="kd_rak" name="kd_rak" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kd_box">Kode Box</label>
                                        <input type="text" class="form-control form-control-sm kd_box" id="kd_box" name="kd_box" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_box">Nomor Box</label>
                                        <input type="number" class="form-control form-control-sm" id="no_box" name="no_box" autocomplete="off" min="1" max="20" oninput="validateTwoDigits(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_sp2d">No. SP2D</label>
                                <input type="text" class="form-control form-control-sm" id="no_sp2d" name="no_sp2d" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="tgl_sp2d">Tanggal SP2D</label>
                                <input type="date" class="form-control form-control-sm" id="tgl_sp2d" name="tgl_sp2d" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="no_kontrak">No. Kontrak</label>
                                <input type="text" class="form-control form-control-sm" id="no_kontrak" name="no_kontrak" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="nilai_kontrak">Nilai Kontrak</label>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id="nilai_kontrak" name="nilai_kontrak" oninput="formatAngka(this)" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <!-- Kolom kedua -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_belanja">Jenis Belanja</label>
                                <input type="text" class="form-control form-control-sm" id="jenis_belanja" name="jenis_belanja" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="bidang">Bidang</label>
                                <select class="form-control form-control-sm id_bid" id="id_bid" name="id_bid" autocomplete="off">
                                    <option value="">Pilih Bidang</option>
                                    <?php $no = 1; ?>
                                    <?php foreach ($bidang as $r) : ?>
                                        <option value="<?= $r['id'] ?>" data-kode='<?= $r['kode'] ?>'><?= $no++ . '. ' . $r['bidang'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_kegiatan">Sub Kegiatan</label>
                                <select class="form-control form-control-sm" id="id_subkeg" name="id_subkeg" autocomplete="off">
                                    <option value="">Pilih Sub Kegiatan</option>
                                    <?php $no = 1; ?>
                                    <?php foreach ($subkeg as $r) : ?>
                                        <option value="<?= $r['id'] ?>" data-chained="<?= $r['id_bid'] ?>"><?= '- ' . $r['sub_kegiatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select class="form-control form-control-sm tahun" id="tahun" name="tahun" autocomplete="off">
                                    <?php
                                    for ($year = 2020; $year <= date('Y'); $year++) {
                                        $selected = ($year == date('Y')) ? 'selected' : '';
                                        echo "<option value='$year' $selected>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">Upload Dokumen</label>
                                <div class="custom-file form-control-sm">
                                    <input type="file" class="custom-file-input" id="file" name="file" onchange="updateFileName()" accept=".pdf">
                                    <label id="file-text" class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan/Uraian</label>
                                <textarea class="form-control form-control-sm" id="ket" name="ket" style="height: 88px;" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-save"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Form Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus dokumen ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="" class="btn btn-danger" id="btnDeleteConfirm">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL MODAL -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="modalDetailLabel"><i class="fas fa-eye"></i> Detail Dokumen</h5>
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-borderless table-striped text-gray-900">
                    <tr>
                        <th style="width: 50%;">KODE RAK</th>
                        <th style="width: 50%;">KODE BOX</th>
                    </tr>
                    <tr>
                        <td><span id="detailKodeRak" class="font-italic"></span></td>
                        <td><span id="detailKodeBox" class="font-italic"></span></td>
                    </tr>
                    <tr>
                        <th>NO SP2D</th>
                        <th>TANGGAL SP2D</th>
                    </tr>
                    <tr>
                        <td><span id="detailNoSp2d" class="font-italic"></td>
                        <td><span id="detailtglSp2d" class="font-italic"></td>
                    </tr>
                    <tr>
                        <th>NOMOR KONTRAK</th>
                        <th>NILAI KONTRAK</th>
                    </tr>
                    <tr>
                        <td><span id="detailNoKontrak" class="font-italic"></td>
                        <td><span id="detailNilaiKontrak" class="font-italic"></td>
                    </tr>
                    <tr>
                        <th>JENIS BELANJA</th>
                        <th>TAHUN</th>
                    </tr>
                    <tr>
                        <td><span id="detailJenisBelanja" class="font-italic"></td>
                        <td><span id="detailTahun" class="font-italic"></td>
                    </tr>
                    <tr>
                        <th>BIDANG</th>
                        <th>SUB KEGIATAN</th>
                    </tr>
                    <tr>
                        <td><span id="detailBidang" class="font-italic"></td>
                        <td><span id="detailSubKegiatan" class="font-italic"></td>
                    </tr>
                    <tr>
                        <th>KETERANGAN/URAIAN</th>
                        <th>DOKUMEN DIGITAL</th>
                    </tr>
                    <tr>
                        <td><span id="detailKet" class="font-italic"></td>
                        <td>
                            <div id="detailFile"></div>
                            <a id="detailFileLink" class="text-decoration-none" target="_blank">&raquo; View Full Document</a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <label class="text-gray-900 float-left mr-auto">Status Dokumen Fisik: <span class="font-weight-bold" id="detailStatus"></span></label>
                <label class="text-gray-900 float-left mr-auto">Tanggal Input: <span class="font-weight-bold" id="detailTglInput"></span></label>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="modalEditLabel">
                    <i class="fas fa-edit"></i> Edit Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="<?= base_url('Dokumen/update') ?>" method="POST" class="text-gray-900" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="id">
                    <div class="row">
                        <!-- Kolom pertama -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editKdRak">Kode Rak</label>
                                <input type="text" class="form-control form-control-sm" id="editKdRak" name="kd_rak" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="editKdBox">Kode Box</label>
                                        <input type="text" class="form-control form-control-sm kd_box" id="kd_box" name="kd_box" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="editNoBox">Nomor Box</label>
                                        <input type="number" class="form-control form-control-sm" id="editNoBox" name="no_box" autocomplete="off" min="1" max="20" oninput="validateTwoDigits(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editNoSp2d">No. SP2D</label>
                                <input type="text" class="form-control form-control-sm" id="editNoSp2d" name="no_sp2d" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="editTglSp2d">Tanggal SP2D</label>
                                <input type="date" class="form-control form-control-sm" id="editTglSp2d" name="tgl_sp2d" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="editNoKontrak">No. Kontrak</label>
                                <input type="text" class="form-control form-control-sm" id="editNoKontrak" name="no_kontrak" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="editNilaiKontrak">Nilai Kontrak</label>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id="editNilaiKontrak" name="nilai_kontrak" oninput="formatAngka(this)" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <!-- Kolom kedua -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editJenisBelanja">Jenis Belanja</label>
                                <input type="text" class="form-control form-control-sm" id="editJenisBelanja" name="jenis_belanja" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="editBidang">Bidang</label>
                                <select class="form-control form-control-sm id_bid" id="id_bid" name="id_bid" autocomplete="off">
                                    <option value="">Pilih Bidang</option>
                                    <?php $no = 1; ?>
                                    <?php foreach ($bidang as $r) : ?>
                                        <option value="<?= $r['id'] ?>" data-kode='<?= $r['kode'] ?>'><?= $no++ . '. ' . $r['bidang'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editSubKegiatan">Sub Kegiatan</label>
                                <select class="form-control form-control-sm" id="id_subkeg" name="id_subkeg" autocomplete="off">
                                    <option value="">Pilih Sub Kegiatan</option>
                                    <?php foreach ($subkeg as $r) : ?>
                                        <option value="<?= $r['id'] ?>" data-chained="<?= $r['id_bid'] ?>"><?= '- ' . $r['sub_kegiatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editTahun">Tahun</label>
                                <select class="form-control form-control-sm tahun" id="tahun" name="tahun" autocomplete="off">
                                    <?php for ($year = 2020; $year <= date('Y'); $year++) : ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editFile">Upload Dokumen</label>
                                <div class="custom-file form-control-sm">
                                    <input type="file" class="custom-file-input" id="editFile" name="file" onchange="editFileName()" accept=".pdf">
                                    <label id="editFileText" class="custom-file-label" for="editFile">Choose file</label>
                                </div>
                                <input type="text" id="oldFile" name="oldFile">
                                <input type="text" id="oldCreated_at" name="oldCreated_at">
                            </div>
                            <div class="form-group">
                                <label for="editKet">Keterangan/Uraian</label>
                                <textarea class="form-control form-control-sm" id="editKet" name="ket" style="height: 88px;" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="formEditDokumen"> <i class="fas fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan detail dokumen -->
<script src="<?= base_url('public') ?>/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event ketika tombol detail diklik
        $('.btn-detail').on('click', function() {
            var id = $(this).data('id'); // Ambil ID dari data-id link
            // Melakukan permintaan AJAX ke controller
            $.ajax({
                url: '<?= base_url("Dokumen/detail") ?>/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Jika data ditemukan, isi modal dengan data
                    if (data.error) {
                        alert(data.error); // Jika data tidak ditemukan
                    } else {
                        $('#detailKodeRak').text(data.kd_rak);
                        $('#detailKodeBox').text(data.kd_box);
                        $('#detailNoSp2d').text(data.no_sp2d);
                        $('#detailtglSp2d').text(data.tgl_sp2d);
                        $('#detailNoKontrak').text(data.no_kontrak);
                        $('#detailNilaiKontrak').text(data.nilai_kontrak);
                        $('#detailBidang').text(data.bidang);
                        $('#detailSubKegiatan').text(data.sub_kegiatan);
                        $('#detailTahun').text(data.tahun);
                        $('#detailKet').text(data.ket);
                        if (data.file == null || data.file == '') {
                            $('#detailFile').html('<b class="text-danger">Dokumen Tidak Tersedia</b>');
                            $('#detailFileLink').hide();
                        } else {
                            // Lakukan pengecekan apakah file dapat diakses
                            var fileUrl = '<?= base_url("public") ?>/uploads/' + data.file;

                            $.ajax({
                                url: fileUrl,
                                method: 'HEAD', // Hanya cek status HTTP
                                success: function() {
                                    // Jika file tersedia, tampilkan iframe
                                    var iframe = $('<iframe>', {
                                        src: fileUrl,
                                        width: '100%',
                                        height: '300px',
                                        class: 'iframe-preview'
                                    });
                                    $('#detailFile').html(iframe);
                                    $('#detailFileLink').show().attr('href', fileUrl);
                                },
                                error: function() {
                                    // Jika file tidak dapat diakses (Forbidden atau Not Found)
                                    $('#detailFile').html('<b class="text-danger">Dokumen Digital Tidak Tersedia atau File Tidak Ditemukan</b>');
                                    $('#detailFileLink').hide();
                                }
                            });
                        }
                        // $('#detailFile').attr('src', '<?= base_url('public') ?>/uploads/' + data.file);
                        $('#detailTglInput').text(data.created_at);
                        $('#detailJenisBelanja').text(data.jenis_belanja);
                        if (data.status == 'TIDAK ADA') {
                            $('#detailStatus').text(data.status).addClass('text-danger').removeClass('text-success');
                        } else {
                            $('#detailStatus').text(data.status).addClass('text-success').removeClass('text-danger');
                        }
                        // Tampilkan modal
                        $('#modalDetail').modal('show');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });
    });
</script>