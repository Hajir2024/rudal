<?php

namespace App\Controllers;

use App\Models\M_Dokumen;
use App\Models\M_Peminjaman;

class Dashboard extends BaseController
{
    protected $dokumen, $peminjaman;

    public function __construct()
    {
        $this->dokumen = new M_Dokumen();
        $this->peminjaman = new M_Peminjaman();
    }
    public function index()
    {
        // Ambil data dari model
        $dokumen_data = $this->dokumen->getTotalDokumenByBidangWithStatus();

        // Pastikan data tidak kosong
        if ($dokumen_data) {
            $bidang_names = [];
            $total_dokumen = [];
            $total_ada = [];
            $total_tidak_ada = [];

            // Iterasi data untuk memisahkan kolom-kolom yang dibutuhkan
            foreach ($dokumen_data as $row) {
                $bidang_names[] = $row['bidang']; // Nama bidang
                $total_dokumen[] = $row['total_dokumen']; // Total dokumen
                $total_ada[] = $row['total_ada']; // Total dokumen ADA
                $total_tidak_ada[] = $row['total_tidak_ada']; // Total dokumen TIDAK ADA
            }
        } else {
            // Jika data kosong, inisialisasi dengan array kosong
            $bidang_names = $total_dokumen = $total_ada = $total_tidak_ada = [];
        }

        // Siapkan data untuk view
        $data = [
            'title' => 'Dashboard',
            'total_arsip' => $this->dokumen->getTotalDokumen(),
            'ready' => $this->dokumen->getTotalStock('ADA'),
            'notready' => $this->dokumen->getTotalStock('TIDAK ADA'),
            'getTopBulan' => $this->peminjaman->getTopPeminjamanBidang('bulan') ?? ['bidang' => 'Tidak Diketahui', 'total_pinjaman' => 0],
            'getTopTahun' => $this->peminjaman->getTopPeminjamanBidang('tahun') ?? ['bidang' => 'Tidak Diketahui', 'total_pinjaman' => 0],
            'dokumen_data' => $dokumen_data, // Data yang diambil dari model
            'bidang_names' => $bidang_names,
            'total_dokumen' => $total_dokumen,
            'total_ada' => $total_ada,
            'total_tidak_ada' => $total_tidak_ada
        ];

        return $this->template->load('v_Dashboard', $data);
    }
}
