<?php

namespace App\Controllers;

use App\Models\M_Dokumen;
use App\Models\M_Bidang;
use App\Models\M_SubKegiatan;

class Dokumen extends BaseController
{
    protected $dokumen;
    protected $bidang;
    protected $subkegiatan;

    public function __construct()
    {
        $this->dokumen = new M_Dokumen();
        $this->bidang = new M_Bidang();
        $this->subkegiatan = new M_SubKegiatan();
    }

    public function index()
    {
        $data = [
            'title' => 'Dokumen',
            'dokumen' => $this->dokumen->getDataDokumen(),
            'bidang' => $this->bidang->getDataBidang(),
            'subkeg' => $this->subkegiatan->getDataSubKeg(),
        ];
        return $this->template->load('v_Dokumen', $data);
    }

    public function simpan()
    {
        $data = [
            'kd_rak'        => $this->request->getVar('kd_rak'),
            'kd_box'        => $this->request->getVar('kd_box') . $this->request->getVar('no_box'),
            'no_sp2d'       => $this->request->getVar('no_sp2d'),
            'tgl_sp2d'      => $this->request->getVar('tgl_sp2d'),
            'no_kontrak'    => $this->request->getVar('no_kontrak'),
            'nilai_kontrak' => preg_replace('/\D/', '', $this->request->getVar('nilai_kontrak')),
            'jenis_belanja' => $this->request->getVar('jenis_belanja'),
            'id_bid'        => $this->request->getVar('id_bid'),
            'id_subkeg'     => $this->request->getVar('id_subkeg'),
            'tahun'         => $this->request->getVar('tahun'),
            'ket'           => $this->request->getVar('ket'),
            'file'          => $this->request->getVar('file')
        ];

        $this->dokumen->save($data);
        return redirect()->to('Dokumen');
    }
}
