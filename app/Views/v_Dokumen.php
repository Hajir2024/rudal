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
    <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                    <a href="#" class="badge badge-success" data-placement="left" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="badge badge-warning btn-detail" data-id="<?= $r['id'] ?>" data-placement="top" title="Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="badge badge-primary" data-placement="down" title="Download">
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
                <form action="<?= base_url('Dokumen/simpan') ?>" method="POST" class="text-gray-900">
                    <div class="row">
                        <!-- Kolom pertama -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kd_rak">Kode Rak</label>
                                <input type="text" class="form-control form-control-sm" id="kd_rak" name="kd_rak" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kd_box">Kode Box</label>
                                        <input type="text" class="form-control form-control-sm" id="kd_box" name="kd_box" required readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_box">Nomor Box</label>
                                        <input type="number" class="form-control form-control-sm" id="no_box" name="no_box" autocomplete="off" min="1" max="20" oninput="validateTwoDigits(this)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_sp2d">No. SP2D</label>
                                <input type="text" class="form-control form-control-sm" id="no_sp2d" name="no_sp2d" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_sp2d">Tanggal SP2D</label>
                                <input type="date" class="form-control form-control-sm" id="tgl_sp2d" name="tgl_sp2d" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="no_kontrak">No. Kontrak</label>
                                <input type="text" class="form-control form-control-sm" id="no_kontrak" name="no_kontrak" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="nilai_kontrak">Nilai Kontrak</label>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id="nilai_kontrak" name="nilai_kontrak" oninput="formatAngka(this)" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <!-- Kolom kedua -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_belanja">Jenis Belanja</label>
                                <input type="text" class="form-control form-control-sm" id="jenis_belanja" name="jenis_belanja" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="bidang">Bidang</label>
                                <select class="form-control form-control-sm" id="id_bid" name="id_bid" autocomplete="off" required>
                                    <option value="">Pilih Bidang</option>
                                    <?php $no = 1; ?>
                                    <?php foreach ($bidang as $r) : ?>
                                        <option value="<?= $r['id'] ?>" data-kode='<?= $r['kode'] ?>'><?= $no++ . '. ' . $r['bidang'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_kegiatan">Sub Kegiatan</label>
                                <select class="form-control form-control-sm" id="id_subkeg" name="id_subkeg" autocomplete="off" required>
                                    <option value="">Pilih Sub Kegiatan</option>
                                    <?php $no = 1; ?>
                                    <?php foreach ($subkeg as $r) : ?>
                                        <option value="<?= $r['id'] ?>" data-chained="<?= $r['id_bid'] ?>"><?= '- ' . $r['sub_kegiatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select class="form-control form-control-sm" id="tahun" name="tahun" autocomplete="off" required>
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
                                    <input type="file" class="custom-file-input" id="file" name="file" onchange="updateFileName()">
                                    <label id="file-text" class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan/Uraian</label>
                                <textarea class="form-control form-control-sm" id="ket" name="ket" style="height: 88px;" autocomplete="off" required></textarea>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detail Konten akan dimuat di sini -->
                <p><strong>Kode Rak:</strong> <span id="detailKodeRak"></span></p>
                <p><strong>Kode Box:</strong> <span id="detailKodeBox"></span></p>
                <p><strong>No SP2D:</strong> <span id="detailNoSp2d"></span></p>
                <p><strong>No Kontrak:</strong> <span id="detailNoKontrak"></span></p>
                <p><strong>Bidang:</strong> <span id="detailBidang"></span></p>
                <p><strong>Sub Kegiatan:</strong> <span id="detailSubKegiatan"></span></p>
                <p><strong>Tahun:</strong> <span id="detailTahun"></span></p>
                <p><strong>Keterangan:</strong> <span id="detailKeterangan"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script>
    function formatAngka(input) {
        // Menghapus semua karakter selain angka
        let value = input.value.replace(/[^0-9]/g, '');
        // Format angka dengan titik setiap ribuan
        let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        // Menetapkan nilai yang sudah diformat kembali ke input
        input.value = formattedValue;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bidangSelect = document.getElementById('id_bid');
        const kdBoxInput = document.getElementById('kd_box');
        const tahunSelect = document.getElementById('tahun');

        bidangSelect.addEventListener('change', function() {
            // Mendapatkan option yang terpilih
            const selectedOption = bidangSelect.options[bidangSelect.selectedIndex];
            // Mengambil nilai dari atribut data-kode
            const kodeValue = selectedOption.getAttribute('data-kode');
            // Mengambil tahun yang terpilih
            const tahunValue = tahunSelect.options[tahunSelect.selectedIndex].value;
            // Menggabungkan nilai data-kode dengan tahun yang dipilih
            kdBoxInput.value = tahunValue + (kodeValue ? '/' + kodeValue : '') + '/';
        });

        // Tambahkan listener untuk perubahan tahun
        tahunSelect.addEventListener('change', function() {
            // Memicu event 'change' di bidangSelect untuk memperbarui kdBoxInput
            bidangSelect.dispatchEvent(new Event('change'));
        });
    });
</script>

<script>
    function validateTwoDigits(input) {
        if (input.value.length > 0) {
            input.value = input.value.slice(0, 2); // Memotong input menjadi 2 digit
        }

        // Memastikan nilai berada dalam rentang 10-99
        if (input.value < 1 || input.value > 10) {
            input.value = ''; // Reset nilai jika di luar rentang
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteConfirmButton = document.getElementById('btnDeleteConfirm');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const deleteUrl = "<?= base_url('Dokumen/hapus/') ?>" + id;
                // Set href pada tombol konfirmasi
                deleteConfirmButton.setAttribute('href', deleteUrl);
                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('modalDelete'));
                modal.show();
            });
        });
    });
</script>