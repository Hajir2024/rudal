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
        $data = [
            'title' => 'Dashboard',
            'total_arsip' => $this->dokumen->getTotalDokumen(),
        ];
        return $this->template->load('v_Dashboard', $data);
    }
}
