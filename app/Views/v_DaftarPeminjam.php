<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-fw fa-hand-holding"></i> <?= $title ?> &raquo; <span class="text-muted"> Daftar Peminjam</span></h4>
</div>
<hr>

<table id="TablePinjam" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Nama</th>
            <th class="text-center">NIP</th>
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
                <td><?= $r['no_hp'] ?></td>
                <td><?= $r['tgl_pinjam'] ?></td>
                <td><?= $r['ket'] ?></td>
                <td class="text-center"> <a href="#" class="badge badge-info" data-toggle="modal" data-target="#detailPinjam" data-id="<?= $r['id'] ?>" rel="noopener noreferrer"><?= $r['total_dokumen']  ?></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="detailPinjam" tabindex="-1" role="dialog" aria-labelledby="detailPinjamLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPinjamLabel">Detail Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your modal content here -->
                <p>Details will be shown here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>