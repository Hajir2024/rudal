<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-fw fa-hand-holding"></i> <?= $title ?> &raquo; <span class="text-muted">Pinjam</span></h4>
    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pinjam"><i class="fas fa-plus"></i> PINJAM</button>
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
            <th class="text-center">Tanggal SP2D</th>
            <th class="text-center">No. Kontrak</th>
            <th class="text-center">Nilai Kontrak</th>
            <th class="text-center">Bidang</th>
            <th class="text-center">Sub Kegiatan</th>
            <th class="text-center">Jenis Belanja</th>
            <th class="text-center">Tahun</th>
            <th class="text-center">Keterangan/Uraian</th>
            <th class="text-center">
                <input type="checkbox" id="checkAll">
            </th>
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
                <td><?= $r['tgl_sp2d'] ?></td>
                <td><?= $r['no_kontrak'] ?></td>
                <td><?= $r['nilai_kontrak'] ?></td>
                <td><?= $r['bidang'] ?></td>
                <td><?= $r['sub_kegiatan'] ?></td>
                <td><?= $r['jenis_belanja'] ?></td>
                <td><?= $r['tahun'] ?></td>
                <td><?= $r['ket'] ?></td>
                <td class="text-center">
                    <?php if ($r['status'] == 'TIDAK ADA') : ?>
                        <a href="#" class="badge badge-info" data-placement="left" title="Info Peminjaman" onclick="alert('Dokumen Sedang Tidak Tersedia (Di Pinjam)')">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    <?php else: ?>
                        <input type="checkbox" class="row-checkbox" data-no_sp2d="<?= $r['no_sp2d'] ?>" data-ket="<?= $r['ket'] ?>" value="<?= $r['id'] ?>">
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- TAMBAH MODAL -->
<div class="modal fade" id="pinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="exampleModalLabel">
                    <i class="fas fa-plus-circle"></i> Tambah Peminjam
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPinjam" action="<?= base_url('Peminjaman/simpan') ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="selected_ids" id="selectedIdsInput">
                    <div class="alert alert-success" role="alert">
                        <h6 class="alert-heading">Dokumen yang dipilih: <span id="totalSelected" class="font-weight-bold text-primary"></span></h6>
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <!-- List group untuk ID yang dipilih -->
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Tab content untuk menampilkan detail ID yang dipilih -->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <span class="font-italic"><strong>Note:</strong> Lengkapi data peminjam pada form dibawah ini:</span>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- Kolom pertama -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="nip">NIP/NIK</label>
                                <input type="text" class="form-control form-control-sm" id="nip" name="nip" autocomplete="off">
                                <small id="nipWarning" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                <input type="date" class="form-control form-control-sm" id="tgl_pinjam" name="tgl_pinjam" autocomplete="off" required>
                                <small id="tglWarning" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Kolom kedua -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit_kerja">Unit Kerja/Bidang</label>
                                <input type="text" class="form-control form-control-sm" id="unit_kerja" name="unit_kerja" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No. HP</label>
                                <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp" autocomplete="off">
                                <small id="noHpWarning" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea class="form-control form-control-sm" id="ket" name="ket" style="height: 88px;" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button id="btnPinjam" type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-save"></i> Simpan</button>
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
        // Checkbox "Check All"
        $('#checkAll').click(function() {
            $('.row-checkbox').prop('checked', this.checked);
        });
        // Tombol "PINJAM" untuk menampilkan modal
        $('.btn-primary').click(function() {
            const selectedIds = [];
            const selectedKets = []; // Array untuk menyimpan data-ket
            const selectedNoSP2Ds = []; // Array untuk menyimpan data-ket

            $('.row-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
                selectedKets.push($(this).data('ket')); // Ambil data-ket
                selectedNoSP2Ds.push($(this).data('no_sp2d')); // Ambil data-no_sp2d
            });
            // Kosongkan data lama di modal
            $('#list-tab').empty();
            $('#nav-tabContent').empty();

            // Masukkan data ID dan data-ket ke modal menggunakan list group dan tab content
            if (selectedIds.length > 0) {
                selectedIds.forEach((id, index) => {
                    const ket = selectedKets[index]; // Ambil data-ket sesuai dengan ID
                    const no_sp2d = selectedNoSP2Ds[index]; // Ambil data-no_sp2d sesuai dengan ID
                    // Menambahkan item ke list group
                    $('#list-tab').append(`
                    <a class="list-group-item list-group-item-action" id="list-${id}-list" data-toggle="list" href="#list-${id}" role="tab" aria-controls="${id}" style="height: 20px; display: flex; justify-content: left; align-items: center;">
                        <span style="font-size: 12px;">No.SP2D: <strong>${no_sp2d}</strong></span>
                    </a>
                `);
                    // Menambahkan tab content terkait dengan ID dan data-ket
                    $('#nav-tabContent').append(`
                    <div class="tab-pane fade" id="list-${id}" role="tabpanel" aria-labelledby="list-${id}-list">
                        <p><strong>Keterangan:</strong> ${ket}</p>
                    </div>
                `);
                });
            } else {
                $('#list-tab').append('<li>Tidak ada data yang dipilih</li>');
            }
            // Masukkan data ID ke input hidden
            $('#totalSelected').text('(' + selectedIds.length + ')');
            $('#selectedIdsInput').val(selectedIds.join(','));
        });
    });
</script>