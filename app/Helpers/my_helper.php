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

function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini . ", " . date("d-m-Y");
}

// ENCRYPT / DECRYPT
function enkrip($string, $key = 258456)
{
    $result = '';
    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }
    return base64_encode($result);
}


function dekrip($string, $key = 258456)
{
    $result = '';
    $string = base64_decode($string);
    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}

function isLoggedIn()
{
    $status = '';
    if (session()->get('isLoggedIn')) {
        if (session()->get('role') == 'user') {
            $status = 'user';
        } else {
            $status = 'admin';
        };
    } else {
        $status = false;
    }
    return $status;
}
