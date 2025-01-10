<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-folder"></i> <?= $title ?> &raquo; <span class="text-muted"> Bidang</span></h4>
</div>
<hr>
<div class="row text-gray-900"">
    <div class=" col-md-6">
    <table id="TableBidang" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th class="text-center">Bidang</th>
                <th class="text-center">Kode Bidang</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($bidang as $r): ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= $r['bidang'] ?></td>
                    <td class="text-center"><?= $r['kode'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="col-md-6">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-900">Tambah Bidang</h4>
    </div>
    <form action="" method="POST" class="text-gray-900" enctype="multipart/form-data">
        <div class="row">
            <!-- Kolom pertama -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bidang">Nama Bidang</label>
                    <input type="text" class="form-control form-control-sm" id="bidang" name="bidang" autocomplete="off">
                </div>
            </div>
            <!-- Kolom kedua -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kode">Kode Bidang</label>
                    <input type="text" class="form-control form-control-sm" id="kode" name="kode" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                <i class="fas fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-save"></i> Tambah</button>
        </div>
    </form>
</div>
</div>