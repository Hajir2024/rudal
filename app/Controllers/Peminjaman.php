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
}
