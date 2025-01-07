<?php

use CodeIgniter\Database\BaseConnection;

if (!function_exists('getNamaBidang')) {
    function getNamaBidang($id)
    {
        // Dapatkan instance database CI4
        $db = \Config\Database::connect();

        // Query database menggunakan Query Builder
        $query = $db->table('bidangs')
            ->select('bidang')
            ->where('id', $id)
            ->get();

        // Ambil hasil
        $row = $query->getRow();

        // Pastikan data ditemukan
        return $row ? $row->bidang : null;
    }
}

function getNamaFile($id, $kd_rak, $kd_box, $no_box, $typeFile)
{
    $bidang = str_replace(' ', '-', getNamaBidang($id));
    // $kode_rak = $this->request->getVar('kd_rak');
    $kode_box = str_replace('/', '-', $kd_box) . $no_box;
    $date = date('Y-m-d_H-i-s', strtotime('+1 hours'));

    $namaFile = $bidang . '_' . $kd_rak . '_' . $kode_box . '_' . $date . '.' . $typeFile;
    return $namaFile;
}
