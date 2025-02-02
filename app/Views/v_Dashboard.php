<?php

use Faker\Provider\Base;
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-900"><i class="fas fa-fw fa-tachometer-alt"></i> <?= $title ?></h1>
</div>
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase">
                            Total Arsip</div>
                        <div class="font-weight-bold text-gray-800" style="font-size: 17px"><?= number_format($total_arsip) ?></div><small class="text-muted">Dokumen</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-uppercase">
                            <span class="text-success">Tersedia</span> / <span class="text-danger">Tidak Tersedia</span>
                        </div>
                        <div class="font-weight-bold text-gray-800" style="font-size: 17px"><?= number_format($ready) . ' / ' . number_format($notready) ?></div>
                        <small class="text-muted">Dokumen</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stream fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-uppercase">
                            <span class="text-info">TERBANYAK DIPINJAM</span>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="mb-0 mr-3 font-weight-bold text-gray-800" style="font-size: 13px"><?= esc($getTopBulan['bidang']) ?></div>
                            </div>
                        </div>
                        <small class="text-muted">Bidang (Bulan Ini): <b><?= esc($getTopBulan['total_pinjaman']) ?></b> Dokumen</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sort-amount-up fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-uppercase">
                            <span class="text-warning">TERBANYAK DIPINJAM</span>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="mb-0 mr-3 font-weight-bold text-gray-800" style="font-size: 13px"><?= esc($getTopTahun['bidang']) ?></div>
                            </div>
                        </div>
                        <small class="text-muted">Bidang (Tahun Ini): <b><?= esc($getTopTahun['total_pinjaman']) ?></b> Dokumen</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sort-amount-up fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="card">
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
</div>

<?php
// Pastikan data ada dan tidak null, jika tidak inisialisasi dengan array kosong
$total_dokumen = $total_dokumen ?? [];
$total_ada = $total_ada ?? [];
$total_tidak_ada = $total_tidak_ada ?? [];

// Pastikan data dalam bentuk numerik, hanya jika ada datanya
$total_dokumen = !empty($total_dokumen) ? array_map('intval', $total_dokumen) : [];
$total_ada = !empty($total_ada) ? array_map('intval', $total_ada) : [];
$total_tidak_ada = !empty($total_tidak_ada) ? array_map('intval', $total_tidak_ada) : [];
?>


<script type="text/javascript">
    // Debugging: Memeriksa apakah data PHP telah benar dikirim ke JavaScript
    var bidangNames = <?= json_encode($bidang_names) ?>;
    var totalDokumen = <?= json_encode($total_dokumen) ?>;
    var totalAda = <?= json_encode($total_ada) ?>;
    var totalTidakAda = <?= json_encode($total_tidak_ada) ?>;

    // Pastikan jika data kosong, tidak menampilkan chart yang kosong
    if (!Array.isArray(bidangNames) || !Array.isArray(totalDokumen)) {
        console.log("Data tidak valid, chart tidak dapat ditampilkan.");
    } else {
        Highcharts.chart('container', {
            chart: {
                type: 'column',
                width: null,
                height: 400
            },
            title: {
                text: 'Dokumen Berdasarkan Bidang'
            },
            subtitle: {
                text: 'Sumber: Database Pengarsipan'
            },
            xAxis: {
                categories: bidangNames,
                crosshair: true,
                accessibility: {
                    description: 'Bidang'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Dokumen'
                }
            },
            tooltip: {
                valueSuffix: ' dokumen'
            },
            series: [{
                    name: 'Total Dokumen',
                    data: totalDokumen
                },
                // {
                //     name: 'Tersedia',
                //     data: totalAda // Data total ADA dari PHP
                // },
                // {
                //     name: 'Tidak Tersedia',
                //     data: totalTidakAda // Data total TIDAK ADA dari PHP
                // }
            ]
        });
    }
</script>