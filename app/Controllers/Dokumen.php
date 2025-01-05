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

        // Validasi input
        if (!$this->validate('dokumenUpload')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
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
        ];

        // MEMBUAT NAMA FILE
        $bidang = str_replace(' ', '-', getNamaBidang($this->request->getVar('id_bid')));
        $kode_rak = $this->request->getVar('kd_rak');
        $kode_box = str_replace('/', '-', $this->request->getVar('kd_box')) . $this->request->getVar('no_box');
        $date = date('Y-m-d_H-i-s', strtotime('+1 hours'));

        $namaFile = $bidang . '_' . $kode_rak . '_' . $kode_box . '_' . $date . '.' . $this->request->getFile('file')->getClientExtension();


        // Proses file upload
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move('public/uploads', $namaFile);  // Pindahkan file ke folder uploads
            $data['file'] = $namaFile;          // Simpan nama file di database
        }

        // Simpan data
        $this->dokumen->save($data);
        // Redirect dengan pesan sukses
        return redirect()->to('Dokumen')->with('success', 'Data berhasil disimpan.');
    }

    public function detail($id)
    {
        // Ambil data dokumen berdasarkan ID
        $dokumen = $this->dokumen->getDokumenById($id);

        // Cek apakah data ditemukan
        if ($dokumen) {
            return $this->response->setJSON($dokumen);
        } else {
            return $this->response->setJSON(['error' => 'Dokumen tidak ditemukan']);
        }
    }

    public function hapus($id)
    {
        // Ambil data dokumen berdasarkan ID
        $dokumen = $this->dokumen->find($id);
        if (!$dokumen) {
            return redirect()->to('Dokumen')->with('error', 'Dokumen tidak ditemukan.');
        }

        // Path file dokumen (pastikan lokasi file benar)
        $filePath = FCPATH . 'public/uploads/' . $dokumen['file']; // Sesuaikan dengan nama kolom di database Anda

        // Hapus file dari server jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        if ($this->dokumen->delete($id)) {
            return redirect()->to('Dokumen')->with('success', 'Dokumen berhasil dihapus.');
        } else {
            return redirect()->to('Dokumen')->with('error', 'Gagal menghapus dokumen.');
        }
    }
}
