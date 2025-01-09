<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SubKegiatan extends Model
{
    protected $table      = 'sub_kegiatans';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_bid', 'sub_kegiatan'];


    public function getDataSubKeg()
    {
        return $this->select('
            sub_kegiatans.*, 
            bidangs.bidang
        ')
            ->join('bidangs', 'bidangs.id = sub_kegiatans.id_bid', 'left')
            ->join('sub_kegiatans as sk', 'sk.id = sub_kegiatans.id_bid', 'left') // alias untuk sub_kegiatans
            ->orderBy('bidangs.id', 'ASC') // pastikan menggunakan sub_kegiatans atau sk
            ->findAll();
    }
}
