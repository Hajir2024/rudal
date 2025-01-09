<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-book"></i> <?= $title ?></h4>
</div>
<hr>

<table id="TablePinjam" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Nama</th>
            <th class="text-center">NIP</th>
            <th class="text-center">Tanggal Peminjaman</th>
            <th class="text-center">No. HP</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Jumlah Dokumen Yang Di Pinjam</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
            <tr>
                <td class="text-center"><?= $i++ ?></td>
                <td class="text-center">Aji</td>
                <td class="text-center">123</td>
                <td>12-12-2012</td>
                <td>0867</td>
                <td>PINJAM DULU 100</td>
                <td></td>
            </tr>
    </tbody>
</table>
