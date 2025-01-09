<?php

namespace App\Controllers;

use App\Models\M_Dokumen;
use App\Models\M_Bidang;
use App\Models\M_SubKegiatan;

class DaftarPeminjam extends BaseController
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
            'title' => 'DAFTAR PEMINJAM',
            'dokumen' => $this->dokumen->getDataDokumen(),
            'bidang' => $this->bidang->getDataBidang(),
            'subkeg' => $this->subkegiatan->getDataSubKeg(),
        ];
        return $this->template->load('v_DaftarPeminjam', $data);
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
            'no_box'        => $this->request->getVar('no_box'),
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

        $id = $this->request->getVar('id_bid');
        $kd_rak = $this->request->getVar('kd_rak');
        $kd_box = $this->request->getVar('kd_box');
        $no_box = $this->request->getVar('no_box');
        $typeFile = $this->request->getFile('file')->getClientExtension();

        $namaFile = getNamaFile($id, $kd_rak, $kd_box, $no_box, $typeFile);

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

    public function update()
    {
        $data = [
            'kd_rak'        => $this->request->getPost('kd_rak'),
            'kd_box'        => $this->request->getPost('kd_box') . $this->request->getPost('no_box'),
            'no_box'        => $this->request->getPost('no_box'),
            'no_sp2d'       => $this->request->getPost('no_sp2d'),
            'tgl_sp2d'      => $this->request->getPost('tgl_sp2d'),
            'no_kontrak'    => $this->request->getPost('no_kontrak'),
            'nilai_kontrak' => preg_replace('/\D/', '', $this->request->getPost('nilai_kontrak')),
            'jenis_belanja' => $this->request->getPost('jenis_belanja'),
            'id_bid'        => $this->request->getPost('id_bid'),
            'id_subkeg'     => $this->request->getPost('id_subkeg'),
            'tahun'         => $this->request->getPost('tahun'),
            'ket'           => $this->request->getPost('ket'),
        ];
        // Handle file upload

        $id     = $this->request->getPost('id');
        $id_bid = $this->request->getPost('id_bid');
        $kd_rak = $this->request->getPost('kd_rak');
        $kd_box = $this->request->getPost('kd_box');
        $no_box = $this->request->getPost('no_box');
        $tahun  = $this->request->getPost('tahun');
        $file   = $this->request->getFile('file');
        $typeFile = $file->getClientExtension();

        $dokumenLama = $this->dokumen->getDokumenById($id);
        $namaFileBaru = getNamaFile($id_bid, $kd_rak, $kd_box, $no_box, "pdf");
        $fileLama = $this->request->getPost('oldFile');
        // dd($dokumenLama);

        // CASE 1: Tidak ada perubahan file jika user tidak upload file baru
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            // Cek apakah ada perubahan pada kolom form tertentu
            if ($dokumenLama['kd_rak'] != $kd_rak || $dokumenLama['kd_box'] != ($kd_box . $no_box) || $dokumenLama['tahun'] != $tahun) {
                // CASE 2: Update nama file jika ada perubahan pada bidang, kode rak, box, atau tahun
                $typeFile = pathinfo($fileLama, PATHINFO_EXTENSION);
                // Ganti nama file di folder uploads
                if (file_exists("public/uploads/" . $fileLama)) {
                    rename("public/uploads/" . $fileLama, "public/uploads/" . $namaFileBaru);
                }
                $data['file'] = $namaFileBaru;
            }
        } else {
            // CASE 3: User mengganti file/upload file baru
            // Hapus file lama jika ada
            if ($fileLama && file_exists("public/uploads/" . $fileLama)) {
                unlink("public/uploads/" . $fileLama);
            }
            // Upload file baru
            $file->move('public/uploads', $namaFileBaru);
            $data['file'] = $namaFileBaru;
        }

        if ($this->dokumen->update($id, $data)) {
            return redirect()->to(base_url('Dokumen'))->with('success', 'Data Berhasil Diperbarui');
        } else {
            return redirect()->to(base_url('Dokumen'))->with('error', 'Gagal Memperbarui Data');
        }
    }

    public function getDokumenById()
    {
        if ($this->request->getMethod() === 'POST') {
            $id = $this->request->getPost('id');
            $dokumen = $this->dokumen->getDokumenById($id);
            if ($dokumen) {
                return $this->response->setJSON($dokumen);
            } else {
                return $this->response->setJSON(['error' => 'Data not found'], 404);
            }
        } else {
            return $this->response->setJSON(['error' => 'Invalid request method'], 405);
        }
    }
}
