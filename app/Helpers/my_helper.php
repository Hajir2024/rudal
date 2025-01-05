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
