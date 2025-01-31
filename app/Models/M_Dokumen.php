<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokumen extends Model
{
    protected $table      = 'dokumens';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kd_rak',
        'kd_box',
        'no_box',
        'no_sp2d',
        'tgl_sp2d',
        'no_kontrak',
        'nilai_kontrak',
        'id_bid',
        'id_subkeg',
        'jenis_belanja',
        'tahun',
        'ket',
        'file',
        'status'
    ];
    public function getDataDokumen()
    {
        return $this->select('
                dokumens.*, 
                bidangs.bidang, 
                sub_kegiatans.sub_kegiatan
            ')
            ->join('bidangs', 'bidangs.id = dokumens.id_bid', 'left')
            ->join('sub_kegiatans', 'sub_kegiatans.id = dokumens.id_subkeg', 'left')
            ->orderBy('dokumens.created_at', 'DESC')
            ->findAll();
    }

    public function getDokumenById($id)
    {
        return $this->select('
                dokumens.*, 
                bidangs.bidang, 
                bidangs.kode, 
                sub_kegiatans.sub_kegiatan
            ')
            ->join('bidangs', 'bidangs.id = dokumens.id_bid', 'left')
            ->join('sub_kegiatans', 'sub_kegiatans.id = dokumens.id_subkeg', 'left')
            ->where('dokumens.id', $id) // Memastikan mengambil data berdasarkan ID
            ->first(); // Mengambil satu baris data
    }

    public function getTotalDokumen()
    {
        return $this->countAll();
    }
}
