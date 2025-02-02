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

    function getTopPeminjamanBidang($waktu)
    {
        if ($waktu == 'bulan') {
            return $this->db->table('peminjamans p') // Menggunakan alias 'p' langsung
                ->select('b.bidang, d.id_bid, COUNT(p.id) AS total_pinjaman')
                ->join('dokumens d', 'p.id_dokumen = d.id')
                ->join('bidangs b', 'd.id_bid = b.id')
                ->where('MONTH(p.tgl_pinjam)', date('m'))
                ->where('YEAR(p.tgl_pinjam)', date('Y'))
                ->where('p.status', 'DI PINJAM')
                ->groupBy('d.id_bid, b.bidang')
                ->orderBy('total_pinjaman', 'DESC')
                ->limit(1) // Hanya ambil bidang dengan pinjaman terbanyak
                ->get()->getRowArray(); // Ambil satu baris hasil query

        } else {
            return $this->db->table('peminjamans p') // Menggunakan alias 'p' langsung
                ->select('b.bidang, d.id_bid, COUNT(p.id) AS total_pinjaman')
                ->join('dokumens d', 'p.id_dokumen = d.id')
                ->join('bidangs b', 'd.id_bid = b.id')
                ->where('YEAR(p.tgl_pinjam)', date('Y')) // Ganti untuk filter berdasarkan tahun
                ->where('p.status', 'DI PINJAM')
                ->groupBy('d.id_bid, b.bidang')
                ->orderBy('total_pinjaman', 'DESC')
                ->limit(1) // Hanya ambil bidang dengan pinjaman terbanyak
                ->get()->getRowArray(); // Ambil satu baris hasil query
        }
    }
}
