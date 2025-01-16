<?php

namespace App\Controllers;

use App\Models\M_Dokumen;
use App\Models\M_Peminjaman;

class Peminjaman extends BaseController
{
    protected $dokumen;
    protected $peminjaman;

    public function __construct()
    {
        $this->dokumen = new M_Dokumen();
        $this->peminjaman = new M_Peminjaman();
    }

    public function Pinjam()
    {
        $data = [
            'title' => 'Peminjaman',
            'dokumen' => $this->dokumen->getDataDokumen(),
        ];
        return $this->template->load('v_Pinjam', $data);
    }

    public function DaftarPeminjam()
    {
        $data = [
            'title' => 'Peminjaman',
            'peminjaman' => $this->peminjaman->getDataPeminjaman(),
        ];
        return $this->template->load('v_DaftarPeminjam', $data);
    }

    public function simpan()
    {
        // Validasi data yang diterima dari form
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'selected_ids'  => 'required',
            'nama'          => 'required|string|max_length[120]',
            'nip'           => 'required|numeric|min_length[1]',
            'tgl_pinjam'    => 'required|valid_date',
            'unit_kerja'    => 'required|string|max_length[255]',
            'no_hp'         => 'required|string|max_length[18]',
            'ket'           => 'required|string|max_length[255]'
        ]);

        // Jika validasi gagal, kembalikan error
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data yang dikirim dari form
        $selectedIds = $this->request->getPost('selected_ids'); // ID yang dipilih
        $nama        = $this->request->getPost('nama');
        $nip         = $this->request->getPost('nip');
        $tgl_pinjam  = $this->request->getPost('tgl_pinjam');
        $unit_kerja  = $this->request->getPost('unit_kerja');
        $no_hp       = $this->request->getPost('no_hp');
        $ket         = $this->request->getPost('ket');

        // Pisahkan ID yang dipilih menjadi array
        $selectedIdsArray = explode(',', $selectedIds);

        // Menyimpan data peminjaman berdasarkan ID yang dipilih
        foreach ($selectedIdsArray as $id) {
            $data = [
                'id_dokumen'    => $id, // ID dokumen yang dipilih
                'nama'          => $nama,
                'nip'           => $nip,
                'tgl_pinjam'    => $tgl_pinjam,
                'unit_kerja'    => $unit_kerja,
                'no_hp'         => $no_hp,
                'ket'           => $ket,
            ];
            // Simpan data peminjaman
            $this->peminjaman->save($data);
        }
        // Redirect setelah berhasil menyimpan
        session()->setFlashdata('success', 'Data peminjaman berhasil disimpan!');
        return redirect()->to('/Pinjam'); // Sesuaikan dengan route yang Anda inginkan
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
}
