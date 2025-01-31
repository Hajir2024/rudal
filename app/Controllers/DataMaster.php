<?php

namespace App\Controllers;

use App\Models\M_Bidang;
use App\Models\M_SubKegiatan;

class DataMaster extends BaseController
{
    protected $bidang;
    protected $subkegiatan;

    public function __construct()
    {
        $this->bidang = new M_Bidang();
        $this->subkegiatan = new M_SubKegiatan();
    }

    public function Bidang($aksi = '', $idx = '')
    {
        $session = session();
        if ($session->get('isLoggedIn') && $session->get('role') != 'admin') {
            return redirect()->to('/');
        }
        $id = dekrip($idx);
        if ($aksi == 'delete') {
            $this->bidang->where('id', $id)->delete();
            if ($this->bidang->affectedRows() > 0) {
                session()->setFlashdata('sukses', 'Data berhasil dihapus');
                return redirect()->to('/Bidang');
            } else {
                session()->setFlashdata('gagal', 'Data gagal dihapus');
                return redirect()->to('/Bidang');
            }
        } elseif ($aksi == 'simpan') {
            $data = [
                'bidang' => $this->request->getPost('bidang'),
                'kode' => $this->request->getPost('kode'),
            ];
            $this->bidang->insert($data);
            if ($this->bidang->affectedRows() > 0) {
                session()->setFlashdata('sukses', 'Data berhasil disimpan');
                return redirect()->to('/Bidang');
            } else {
                session()->setFlashdata('gagal', 'Data gagal disimpan');
                return redirect()->to('/Bidang');
            }
            return redirect()->to('/Bidang');
        } else {
            $data = [
                'title' => 'Data Master',
                'bidang' => $this->bidang->getDataBidang(),
            ];
            return $this->template->load('v_Bidang', $data);
        }
    }

    public function SubKegiatan($aksi = '', $idx = '')
    {
        $session = session();
        if ($session->get('isLoggedIn') && $session->get('role') != 'admin') {
            return redirect()->to('/');
        }
        $id = dekrip($idx);
        if ($aksi == 'delete') {
            $this->subkegiatan->where('id', $id)->delete();
            if ($this->subkegiatan->affectedRows() > 0) {
                session()->setFlashdata('sukses', 'Data berhasil dihapus');
                return redirect()->to('/SubKegiatan');
            } else {
                session()->setFlashdata('gagal', 'Data gagal dihapus');
                return redirect()->to('/SubKegiatan');
            }
            return redirect()->to('/SubKegiatan');
        } elseif ($aksi == 'simpan') {
            $data = [
                'id_bid' => $this->request->getPost('id_bid'),
                'sub_kegiatan' => $this->request->getPost('subkegiatan'),
            ];
            $this->subkegiatan->insert($data);
            if ($this->subkegiatan->affectedRows() > 0) {
                session()->setFlashdata('sukses', 'Data berhasil disimpan');
                return redirect()->to('/SubKegiatan');
            } else {
                session()->setFlashdata('gagal', 'Data gagal disimpan');
                return redirect()->to('/SubKegiatan');
            }
            return redirect()->to('/SubKegiatan');
        } else {
            $data = [
                'title' => 'Data Master',
                'bidang' => $this->bidang->getDataBidang(),
                'subkeg' => $this->subkegiatan->getDataSubKeg(),
            ];
            return $this->template->load('v_SubKegiatan', $data);
        }
    }
}
