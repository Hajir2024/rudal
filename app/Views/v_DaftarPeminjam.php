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
                <td class="text-center">
                    <a href="#" class="badge badge-warning btn-detail" data-id="<?= $r['id'] ?>" data-placement="top" title="Detail">
                        <i class="fas fa-eye"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>