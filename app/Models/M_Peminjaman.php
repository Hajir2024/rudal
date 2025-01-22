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
            ->where('peminjamans.status', 'DI PINJAM')
            ->groupBy('peminjamans.nip')
            ->orderBy('dokumens.id', 'ASC')
            ->findAll();
    }

    function getInfoPeminjam($id)
    {
        return $this->db->table('peminjamans')->getWhere([
            'id_dokumen' => $id,
            'status' => 'DI PINJAM'
        ])->getRowArray();
    }
}
