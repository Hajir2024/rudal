<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Peminjaman extends Model
{
    protected $table      = 'peminjamans';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id_dokumen',
        'nama',
        'nip',
        'unit_kerja',
        'no_hp',
        'tgl_pinjam',
        'ket',
        'status'
    ];
    public function getDataPeminjaman()
    {
        return $this->select('
            peminjamans.*, 
            dokumens.id as dokumen_id,
            COUNT(*) AS total_dokumen
        ')
            ->join('dokumens', 'dokumens.id = peminjamans.id_dokumen', 'left')
            ->groupBy('peminjamans.nama')
            ->orderBy('dokumens.id', 'ASC')
            ->findAll();
    }
}
