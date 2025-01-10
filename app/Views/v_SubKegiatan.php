<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-900"> <i class="fas fa-folder"></i> <?= $title ?> &raquo; <span class="text-muted"> Sub Kegiatan</span></h4>
</div>
<hr>
<div class="row text-gray-900"">
    <div class=" col-md-6">
    <table id="TableSubKegiatan" class="table table-striped table-hover table-sm table-bordered text-gray-900" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th class="text-center">Bidang</th>
                <th class="text-center">Sub Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($subkeg as $r): ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td><?= $r['bidang'] ?></td>
                    <td><?= $r['sub_kegiatan'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="col-md-6">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-900">Tambah Sub Kegiatan</h4>
    </div>
    <form action="" method="POST" class="text-gray-900" enctype="multipart/form-data">
        <div class="row">
            <!-- Kolom pertama -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bidang">Bidang</label>
                    <select class="form-control form-control-sm id_bid" id="id_bid" name="id_bid" autocomplete="off">
                        <option value="">Pilih Bidang</option>
                        <?php $no = 1; ?>
                        <?php foreach ($bidang as $r) : ?>
                            <option value="<?= $r['id'] ?>"><?= $no++ . '. ' . $r['bidang'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Kolom kedua -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="subkegiatan">Sub Kegiatan</label>
                    <input type="text" class="form-control form-control-sm" id="subkegiatan" name="subkegiatan" autocomplete="off">
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